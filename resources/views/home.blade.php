<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CV & CL Generator</title>

    <!-- Styles / Scripts -->
    @vite(['resources/js/app.js', 'resources/scss/home.scss'])
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center fs-4">CV & CL Generator Form</h1>
        <form id="generatorForm" method="POST" action="{{ route('submit') }}">
            @csrf
            <!-- start step indicators -->
            <div class="form-header d-flex mb-4">
                <span class="stepIndicator">Personal details</span>
                <span class="stepIndicator">Work experience</span>
                <span class="stepIndicator">Education</span>
                <span class="stepIndicator">Skills</span>
                <span class="stepIndicator">Languages</span>
                <span class="stepIndicator">Hobbies</span>
                <span class="stepIndicator">Job application</span>
            </div>
            <!-- end step indicators -->
            
            @if ($errors->any())
    <div class="alert alert-danger text-center">
        <strong>⚠️ Please, complete all required fields.</strong>
    </div>
@endif

            <!-- step one -->
<div class="step">
    <h2 class="text-center mb-4">Personal details</h2>
    <div class="mb-3">
        <input type="text" 
               placeholder="Fullname" 
               name="fullname" 
               value="{{ old('fullname') }}" 
               class="form-control @error('fullname') is-invalid @enderror">
        @error('fullname')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <input type="email" 
               placeholder="Email Address" 
               name="email" 
               value="{{ old('email') }}" 
               class="form-control @error('email') is-invalid @enderror">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <input type="text" 
               placeholder="Phone Number" 
               name="phone" 
               value="{{ old('phone') }}" 
               class="form-control @error('phone') is-invalid @enderror">
        @error('phone')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <input type="text" 
               placeholder="Location" 
               name="location" 
               value="{{ old('location') }}" 
               class="form-control @error('location') is-invalid @enderror">
        @error('location')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>


            <!-- step two -->
            <div class="step">
    <h2 class="text-center mb-4">Work experience</h2>

    <div id="workExperienceContainer">
        @if (old('jobTitles'))
            @foreach (old('jobTitles', []) as $index => $job)
                <div class="work-experience-entry mb-3 p-3 border rounded">
                    <!-- Job Title -->
                    <input type="text" class="form-control mb-2 @error('jobTitles.' . $index) is-invalid @enderror" 
                           placeholder="Job Title" name="jobTitles[]" value="{{ $job }}">
                    @error('jobTitles.' . $index)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <!-- Company Name -->
                    <input type="text" class="form-control mb-2 @error('companyNames.' . $index) is-invalid @enderror" 
                           placeholder="Company Name" name="companyNames[]" value="{{ old('companyNames.' . $index) }}">
                    @error('companyNames.' . $index)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <!-- Work Duration -->
                    <select class="form-select mb-2 @error('workDurations.' . $index) is-invalid @enderror" name="workDurations[]">
                        <option value="" disabled selected>Select duration</option>
                        <option value="Less than 1 year" {{ old('workDurations.' . $index) == 'Less than 1 year' ? 'selected' : '' }}>Less than 1 year</option>
                        <option value="1 - 2 years" {{ old('workDurations.' . $index) == '1 - 2 years' ? 'selected' : '' }}>1 - 2 years</option>
                        <option value="3 - 5 years" {{ old('workDurations.' . $index) == '3 - 5 years' ? 'selected' : '' }}>3 - 5 years</option>
                        <option value="More than 5 years" {{ old('workDurations.' . $index) == 'More than 5 years' ? 'selected' : '' }}>More than 5 years</option>
                    </select>
                    @error('workDurations.' . $index)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <!-- Job Description -->
                    <div class="mb-3">
                        <textarea class="form-control no-resize @error('jobDescriptions.' . $index) is-invalid @enderror" 
                                  placeholder="Job Description" name="jobDescriptions[]" rows="4">{{ old('jobDescriptions.' . $index) }}</textarea>
                        @error('jobDescriptions.' . $index)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="button" class="btn btn-danger btn-sm" onclick="removeWorkExperience(this)">Remove</button>
                </div>
            @endforeach
        @endif
    </div>

                <button type="button" class="btn btn-success mt-3 mb-5" onclick="addWorkExperience()">Add Work Experience</button>
            </div>


            <script>
                function addWorkExperience() {
                    var container = document.getElementById("workExperienceContainer");

                    var div = document.createElement("div");
                    div.classList.add("work-experience-entry", "mb-3", "p-3", "border", "rounded");

                    div.innerHTML = `
            <input type="text" class="form-control mb-2" placeholder="Job Title" name="jobTitles[]" value="{{ old('jobTitles[]') }}" >
            <input type="text" class="form-control mb-2" placeholder="Company Name" name="companyNames[]" value="{{ old('companyNames[]') }}" >
            <select class="form-select mb-2" name="workDurations[]" >
                <option value="" disabled selected>Select duration</option>
                <option value="Less than 1 year" {{ old('workDurations[]') == 'Less than 1 year' ? 'selected' : '' }}>Less than 1 year</option>
                <option value="1 - 2 years" {{ old('workDurations[]') == '1 - 2 years' ? 'selected' : '' }}>1 - 2 years</option>
                <option value="3 - 5 years" {{ old('workDurations[]') == '3 - 5 years' ? 'selected' : '' }}>3 - 5 years</option>
                <option value="More than 5 years" {{ old('workDurations[]') == 'More than 5 years' ? 'selected' : '' }}>More than 5 years</option>
            </select>
            <div class="mb-3">
                <textarea class="form-control no-resize" placeholder="Job Description" name="jobDescriptions[]" rows="4" >{{ old('jobDescriptions[]') }}</textarea>
            </div>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeWorkExperience(this)">Remove</button>
        `;

                    container.appendChild(div);
                }

                function removeWorkExperience(button) {
                    button.parentElement.remove();
                }
            </script>

            <!-- step three -->
<div class="step">
    <h2 class="text-center mb-4">Education</h2>

    <div id="educationContainer">
        @if (old('educationTitles'))
            @foreach (old('educationTitles', []) as $index => $education)
                <div class="education-entry mb-3 p-3 border rounded">
                    <!-- Education Title -->
                    <input type="text" class="form-control mb-2 @error('educationTitles.' . $index) is-invalid @enderror" 
                           placeholder="Education Title" name="educationTitles[]" value="{{ $education }}">
                    @error('educationTitles.' . $index)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <!-- Institution -->
                    <input type="text" class="form-control mb-2 @error('institutions.' . $index) is-invalid @enderror" 
                           placeholder="Institution" name="institutions[]" value="{{ old('institutions.' . $index) }}">
                    @error('institutions.' . $index)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <button type="button" class="btn btn-danger btn-sm" onclick="removeEducation(this)">Remove</button>
                </div>
            @endforeach
        @endif
    </div>

    <div class="d-flex align-items-center mt-3 mb-5">
        <button type="button" id="addEducationButton" class="btn btn-success" onclick="addEducation()">Add Education</button>
    </div>
</div>

<script>
    function addEducation() {
        var container = document.getElementById("educationContainer");

        var div = document.createElement("div");
        div.classList.add("education-entry", "mb-3", "p-3", "border", "rounded");

        div.innerHTML = `
            <input type="text" class="form-control mb-2" placeholder="Education Title" name="educationTitles[]" value="{{ old('educationTitles[]') }}" >
            <input type="text" class="form-control mb-2" placeholder="Institution" name="institutions[]" value="{{ old('institutions[]') }}" >
            <button type="button" class="btn btn-danger btn-sm" onclick="removeEducation(this)">Remove</button>
        `;

        container.appendChild(div);
    }

    function removeEducation(button) {
        button.parentElement.remove();
    }
</script>

            <!-- step four -->
            <div class="step">
                <h2 class="text-center mb-4">Skills</h2>

                <div id="skillContainer">
                    @if (old('skills'))
                    @foreach (old('skills') as $index => $skill)
                    <div class="skill-entry mb-3 p-3 border rounded">
                        <input type="text" class="form-control mb-2 @error('skills.' . $index) is-invalid @enderror" placeholder="Skill" name="skills[]" value="{{ $skill }}">

                        @error('skills.' . $index)
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <button type="button" class="btn btn-danger btn-sm" onclick="removeSkill(this)">Remove</button>
                    </div>
                    @endforeach
                    @endif
                </div>

                <div class="d-flex align-items-center mt-3 mb-5">
                    <button type="button" id="addSkillButton" class="btn btn-success" onclick="addSkill()">Add Skill</button>
                </div>
            </div>


            <script>
                function addSkill() {
                    var container = document.getElementById("skillContainer");
                    var skillCount = container.getElementsByClassName("skill-entry").length;
                    var addButton = document.getElementById("addSkillButton");

                    if (skillCount >= 5) {
                        addButton.disabled = true;
                        return;
                    }

                    var div = document.createElement("div");
                    div.classList.add("skill-entry", "mb-3", "p-3", "border", "rounded");

                    div.innerHTML = `
            <input type="text" class="form-control mb-2" placeholder="Skill" name="skills[]" >
            <button type="button" class="btn btn-danger btn-sm" onclick="removeSkill(this)">Remove</button>
        `;

                    container.appendChild(div);
                }

                function removeSkill(button) {
                    var container = document.getElementById("skillContainer");
                    var addButton = document.getElementById("addSkillButton");

                    button.parentElement.remove();

                    if (container.getElementsByClassName("skill-entry").length < 5) {
                        addButton.disabled = false;
                    }
                }
            </script>

            <!-- step five -->
<div class="step">
    <h2 class="text-center mb-4">Languages</h2>

    <div id="languageContainer">
        @if (old('languages'))
            @foreach (old('languages', []) as $index => $language)
                <div class="language-entry mb-3 p-3 border rounded">
                    <!-- Language Input -->
                    <input type="text" class="form-control mb-2 @error('languages.' . $index) is-invalid @enderror" 
                           placeholder="Language" name="languages[]" value="{{ $language }}">
                    @error('languages.' . $index)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <!-- Level Select -->
                    <select class="form-select mb-2 @error('levels.' . $index) is-invalid @enderror" name="levels[]">
                        <option value="" disabled selected>Select Level</option>
                        <option value="Beginner" {{ old('levels')[$index] ?? '' == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="Intermediate" {{ old('levels')[$index] ?? '' == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="Advanced" {{ old('levels')[$index] ?? '' == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                        <option value="Native" {{ old('levels')[$index] ?? '' == 'Native' ? 'selected' : '' }}>Native</option>
                    </select>
                    @error('levels.' . $index)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <button type="button" class="btn btn-danger btn-sm" onclick="removeLanguage(this)">Remove</button>
                </div>
            @endforeach
        @endif
    </div>

    <div class="d-flex align-items-center mt-3 mb-5">
        <button type="button" id="addLanguageButton" class="btn btn-success" onclick="addLanguage()">Add Language</button>
    </div>
</div>

<script>
    function addLanguage() {
        var container = document.getElementById("languageContainer");
        var languageCount = container.getElementsByClassName("language-entry").length;
        var addButton = document.getElementById("addLanguageButton");

        if (languageCount >= 5) {
            addButton.disabled = true;
            return;
        }

        var div = document.createElement("div");
        div.classList.add("language-entry", "mb-3", "p-3", "border", "rounded");

        div.innerHTML = `
            <input type="text" class="form-control mb-2" placeholder="Language" name="languages[]">
            <select class="form-select mb-2" name="levels[]">
                <option value="" disabled selected>Select Level</option>
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
                <option value="Native">Native</option>
            </select>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeLanguage(this)">Remove</button>
        `;

        container.appendChild(div);
    }

    function removeLanguage(button) {
        var container = document.getElementById("languageContainer");
        var addButton = document.getElementById("addLanguageButton");

        button.parentElement.remove();

        if (container.getElementsByClassName("language-entry").length < 5) {
            addButton.disabled = false;
        }
    }
</script>


            <!-- step six -->
            <div class="step">
                <h2 class="text-center mb-4">Hobbies</h2>

                <div id="hobbyContainer">
                    @if (old('hobbies'))
                    @foreach (old('hobbies') as $index => $hobby)
                    <div class="hobby-entry mb-3 p-3 border rounded">
                        <input type="text" class="form-control mb-2 @error('hobbies.' . $index) is-invalid @enderror" placeholder="Hobby" name="hobbies[]" value="{{ $hobby }}">

                        @error('hobbies.' . $index)
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <button type="button" class="btn btn-danger btn-sm" onclick="removeHobby(this)">Remove</button>
                    </div>
                    @endforeach
                    @endif
                </div>

                <div class="d-flex align-items-center mt-3 mb-5">
                    <button type="button" id="addHobbyButton" class="btn btn-success" onclick="addHobby()">Add Hobby</button>
                    <span id="maxHobbiesMessage" class="text-danger ms-3 fw-bold" style="display: none; font-size: 0.9rem;">Max 5 hobbies allowed</span>
                </div>
            </div>

            <script>
                function addHobby() {
                    var container = document.getElementById("hobbyContainer");
                    var hobbyCount = container.getElementsByClassName("hobby-entry").length;
                    var addButton = document.getElementById("addHobbyButton");
                    var message = document.getElementById("maxHobbiesMessage");

                    if (hobbyCount >= 5) {
                        addButton.disabled = true;
                        message.style.display = "inline";
                        return;
                    }

                    var div = document.createElement("div");
                    div.classList.add("hobby-entry", "mb-3", "p-3", "border", "rounded");

                    div.innerHTML = `
            <input type="text" class="form-control mb-2" placeholder="Hobby" name="hobbies[]" value="{{ old('hobbies[]') }}">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeHobby(this)">Remove</button>
        `;

                    container.appendChild(div);

                    if (container.getElementsByClassName("hobby-entry").length >= 5) {
                        addButton.disabled = true;
                        message.style.display = "inline";
                    }
                }

                function removeHobby(button) {
                    var container = document.getElementById("hobbyContainer");
                    var addButton = document.getElementById("addHobbyButton");
                    var message = document.getElementById("maxHobbiesMessage");

                    button.parentElement.remove();

                    if (container.getElementsByClassName("hobby-entry").length < 5) {
                        addButton.disabled = false;
                        message.style.display = "none";
                    }
                }
            </script>

            <!-- step seven -->
<div class="step">
    <h2 class="text-center mb-4">Job Application</h2>

    <div class="mb-3">
        <input type="text" 
               placeholder="Job Title" 
               name="jobApplicationTitle" 
               value="{{ old('jobApplicationTitle') }}" 
               class="form-control @error('jobApplicationTitle') is-invalid @enderror">
        @error('jobApplicationTitle')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <textarea class="form-control no-resize @error('jobApplicationDescription') is-invalid @enderror" 
                  placeholder="Job Application Description" 
                  name="jobApplicationDescription" 
                  rows="4">{{ old('jobApplicationDescription') }}</textarea>
        @error('jobApplicationDescription')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

            <!-- start previous / next buttons -->
            <div class="form-footer d-flex">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
            <!-- end previous / next buttons -->
        </form>
    </div>

    <div id="loadingMessage" style="display: none;">
        <div class="loading-overlay">
            <p>Submitting data. Please wait...</p>
        </div>
    </div>

    <script>
        var currentTab = 0;
        showTab(currentTab);

        function showTab(n) {
            var x = document.getElementsByClassName("step");
            x[n].style.display = "block";

            document.getElementById("prevBtn").style.display = (n == 0) ? "none" : "inline";

            document.getElementById("nextBtn").innerHTML = (n == x.length - 1) ? "Submit" : "Next";

            fixStepIndicator(n);
        }

        function nextPrev(n) {
            var x = document.getElementsByClassName("step");

            if (n == 1) {
                var inputs = x[currentTab].querySelectorAll("input[required], select[required], textarea[required]");

                for (var i = 0; i < inputs.length; i++) {
                    if (!inputs[i].checkValidity()) {
                        inputs[i].reportValidity();
                        return false;
                    }
                }
            }

            x[currentTab].style.display = "none";
            currentTab += n;

            if (currentTab >= x.length) {
                document.getElementById("generatorForm").submit();
                document.getElementById("loadingMessage").style.display = "flex";
                return false;
            }

            showTab(currentTab);
        }

        function fixStepIndicator(n) {
            var x = document.getElementsByClassName("stepIndicator");
            for (var i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            x[n].className += " active";
        }
    </script>
</body>

</html>