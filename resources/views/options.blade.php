<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV & CL Generator</title>
    <!-- Styles / Scripts -->
    @vite(['resources/scss/options.scss', 'resources/js/options.js'])
</head>
<body>

    <h1>Data submitted successfully!</h1>
    <p>What would you like to do next?</p>
    
    <div>
        <a href="{{ route('previewCV') }}" class="button" target="_blank">CV Preview</a>
        <a href="{{ route('downloadCV') }}" class="button">Download CV</a>
        <a href="{{ route('regenerateCV') }}" class="button" onclick="showLoading()">Regenerate CV</a>
    </div>
    <div>
        <a href="{{ route('previewCL') }}" class="button" target="_blank">CL Preview</a>
        <a href="{{ route('downloadCL') }}" class="button">Download CL</a>
        <a href="{{ route('regenerateCL') }}" class="button" onclick="showLoading()">Regenerate CL</a>
    </div>

    <a class="link-goto" href="{{ route('home') }}">Go to home</a>
    
    @if(session('success'))
        <div id="success-message">
            {{ session('success') }}
        </div>

        <script>
            
        </script>
    @endif
    
    <div id="loading-message">
        ⏳ Regenerating... Please wait.
    </div>

</body>
</html>
