<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MistralAI;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneratorController extends Controller
{   
    protected $mistral;

    public function __construct(MistralAI $mistral)
    {
        $this->mistral = $mistral;
    }

    public function submit(Request $request)
    {   
        $rules = [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'jobApplicationTitle' => 'required|string|max:255',
            'jobApplicationDescription' => 'required|string|max:1000',
        ];

        if ($request->has('jobTitles') && count($request->input('jobTitles')) > 0) {
            $rules['jobTitles.*'] = 'required|string|max:255';
            $rules['companyNames.*'] = 'required|string|max:255';
            $rules['workDurations.*'] = 'required|string';
            $rules['jobDescriptions.*'] = 'required|string|max:1000';
        }

        if ($request->has('educationTitles') && count($request->input('educationTitles')) > 0) {
            $rules['educationTitles.*'] = 'required|string|max:255';
            $rules['institutions.*'] = 'required|string|max:255';
        }

        if ($request->has('skills') && count($request->input('skills')) > 0) {
            $rules['skills.*'] = 'required|string|max:255';
        }

        if ($request->has('hobbies') && count($request->input('hobbies')) > 0) {
            $rules['hobbies.*'] = 'required|string|max:255';
        }

        if ($request->has('languages') && count($request->input('languages')) > 0) {
            $rules['languages.*'] = 'required|string|max:255';
            $rules['levels.*'] = 'required|string';
        }

        $validatedData = $request->validate($rules, [
            'skills.*.required' => 'The skill field is required.',
            'hobbies.*.required' => 'The hobby field is required.',
            'languages.*.required' => 'The language fields are required.',
            'jobTitles.*.required' => 'The job title field is required.',
            'companyNames.*.required' => 'The company name field is required.',
            'jobDescriptions.*.required' => 'The job description field is required.',
            'educationTitles.*.required' => 'The education title field is required.',
            'institutions.*.required' => 'The institution field is required.',
        ]);

        session(['cvData' => $request->all()]);

        $this->generateCV();
        $this->generateCL();

        return view('options');
    }

    public function generateCV()
    {
        $data = session('cvData');

        if ($data) {

            $skillsText = $this->getSkills($data['skills']);
        
            // Generate About Me        
            $jobApplicationTitle = $data['jobApplicationTitle'];
            $jobApplicationDescription = $data['jobApplicationDescription'];
            $prompt = "Generate a short About Me section for a $jobApplicationTitle based on this job roles: $jobApplicationDescription. $skillsText No more than 30 words";
            $aboutMe = $this->generateAIText($prompt);

            // Generate experienceDescription
            $refactoredExperiences = [];

            if (!empty($data['jobTitles']) && !empty($data['jobDescriptions'])) {
                foreach ($data['jobTitles'] as $index => $jobTitle) {
                    $jobDescription = $data['jobDescriptions'][$index];

                    $prompt = "Based in this task descriptions: $jobDescription for a $jobTitle position refactorize the task descriptions considering that I'm applying for this new job: $jobApplicationTitle with this role description: $jobApplicationDescription. No more than 40 words";

                    $newJobDescription = $this->generateAIText($prompt);

                    $refactoredExperiences[] = [
                        'jobTitle' => $jobTitle,
                        'originalDescription' => $jobDescription,
                        'refactoredDescription' => $newJobDescription,
                        'companyName' => $data['companyNames'][$index],
                        'workDuration' => $data['workDurations'][$index]
                    ];
                }
            }

            session(['aboutMe' => $aboutMe, 'refactoredExperiences' => $refactoredExperiences]);
        }
    }

    public function generateCL()
    {
        $data = session('cvData');

        if ($data) {

            $skillsText = $this->getSkills($data['skills']);

            // Generate Cover Letter       
            $jobApplicationTitle = $data['jobApplicationTitle'];
            $jobApplicationDescription = $data['jobApplicationDescription'];
            $prompt = "Generate 3 paragraph for a cover letter (introduction, body and closing) for a $jobApplicationTitle position based on this job roles: $jobApplicationDescription. $skillsText I want max 100 words for each paragraph. I don't want the title for each paragraph. No Dear and Sincerely text and neither paragraphs section title";

            $clData = $this->generateAIText($prompt);

            session(['clData' => $clData]);
        }
    }

    public function previewCV()
    {   
        return view('previewCV', [
            'cvData' => session('cvData'),
            'aboutMe' => session('aboutMe'),
            'refactoredExperiences' => session('refactoredExperiences')
        ]);
    }

    public function downloadCV()
    {
        $pdf = Pdf::loadView('previewCV', [
            'cvData' => session('cvData'),
            'aboutMe' => session('aboutMe'),
            'refactoredExperiences' => session('refactoredExperiences')
        ]);

        return $pdf->download('cv.pdf');
    }

    public function regenerateCV()
    {
        $this->generateCV();

        session()->flash('success', 'CV regenerated successfully!');

        return redirect()->route('options');
    }

    public function previewCL()
    {   
        return view('previewCL', [
            'cvData' => session('cvData'),
            'clData' => session('clData')
        ]);
    }
    
    public function downloadCL()
    {
        $pdf = Pdf::loadView('previewCL', [
            'cvData' => session('cvData'),
            'clData' => session('clData')
        ]);

        return $pdf->download('cl.pdf');
    }

    public function regenerateCL()
    {
        $this->generateCL();

        session()->flash('success', 'CL regenerated successfully!');

        return redirect()->route('options');
    }

    public function generateAIText($prompt)
    {   
        return $this->mistral->generateText($prompt);
    }

    public function options()
    {
        if (!session('cvData')) {
            return redirect()->route('home');
        }

        return view('options');
    }
    
    public function home()
    {
        return view('home');
    }

    public function getSkills($skillsArray)
    {
        $skillsText = "";
        if (!empty($skillsArray)) {
            $skills = implode(', ', $skillsArray);
            $skillsText = "and consider my skills if are relevant for the job position: $skills";
        }

        return $skillsText;
    }
}
