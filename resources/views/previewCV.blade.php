<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background: #fdfdfd;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            color: #417fad;
            font-size: 50px;
        }

        .header p {
            font-size: 28px;
            padding: 0;
            margin: 10px 0;
        }

        .section-title {
            font-size: 22px;
            color: #339fff;
            border-bottom: 2px solid #339fff;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .contact-info p {
            font-size: 16px;
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>{{ $cvData['fullname'] }}</h1>
            <p>{{ $cvData['jobApplicationTitle'] }}</p>
            <div class="contact-info">
                <p>Email: {{ $cvData['email'] }}</p>
                <p>Phone: {{ $cvData['phone'] }}</p>
                <p>Location: {{ $cvData['location'] }}</p>
            </div>
        </div>

        <!-- About Me -->
        <div class="aboutMe">
            <h2 class="section-title">About Me</h2>
            <p>{{ $aboutMe }}</p>
            </ul>
        </div>

        <!-- Work experience -->
        @if (!empty($refactoredExperiences))
        <div class="experience">
            <h2 class="section-title">Work Experience</h2>
            <ul>
                @foreach ($refactoredExperiences as $experience)
                <li>
                    <p>
                        <strong>{{ $experience['jobTitle'] }}</strong> - {{ $experience['companyName'] }}
                        ({{ $experience['workDuration'] }})
                    </p>
                    <p>
                        {{ $experience['refactoredDescription'] }}
                    </p>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Education -->
        @if (!empty($cvData['educationTitles']))
        <div class="education">
            <h2 class="section-title">Education</h2>
            <ul>
                @foreach ($cvData['educationTitles'] as $index => $educationTitle)
                <li>
                    <p>
                        <strong>{{ $educationTitle }} </strong> - {{ $cvData['institutions'][$index] }}
                    </p>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Languages -->
        @if (!empty($cvData['languages']))
        <div class="languages">
            <h2 class="section-title">Languages</h2>
            <ul>
                @foreach ($cvData['languages'] as $index => $language)
                <li>
                    <p>
                        {{ $language }} - {{ $cvData['levels'][$index] }}
                    </p>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Skills -->
        @if (!empty($cvData['skills']))
        <div class="skills">
            <h2 class="section-title">Skills</h2>
            <p>{{ implode(', ', array_slice($cvData['skills'], 0, -1)) }}@if (count($cvData['skills']) > 1), @endif{{ end($cvData['skills']) }}</p>
        </div>
        @endif

        <!-- Hobbies -->
        @if (!empty($cvData['hobbies']))
        <div class="hobbies">
            <h2 class="section-title">Hobbies</h2>
            <p>{{ implode(', ', array_slice($cvData['hobbies'], 0, -1)) }}@if (count($cvData['hobbies']) > 1), @endif{{ end($cvData['hobbies']) }}</p>
        </div>
        @endif

    </div>

</body>

</html>