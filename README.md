# AI Generator

This project developed with Laravel is a CV and Cover Letter generator with AI. It consists on a multi step form to add information about personal details, work experiences, educations, skills, languages and hobbies. On the last step the user has to enter a job applying position and task descriptions.

After data is submitted the AI will generate a CV and Cover Letter for the appyling position.

The user will be able to preview CV and Cover Letter, download in a pdf or regenerate with new AI texts.

## Mistral AI

For generate the AI texts the project connects to the Mistral AI API. Which text will be generated? 

CV:
- "About me" section considering the user skills and job applying position.
- Work experience descriptions will be optimized to match with job applying position.

Cover Letter:
- 3 paragraph: introduction, body and closing considering thue user skills and job applying position.

## Live Demo
https://ai-generator-production.up.railway.app/

## Instalation on localhost

Before installing and running this project, ensure that your system meets the following requirements:

- **PHP**: Version **8.2** or higher  
- **Composer**: Version **2.6** or higher  
- **Node.js**: Version **18+**

1. Clone repository:

    ```bash
    git clone https://github.com/guidorosman/AI-Generator.git
    ```
2. Enter directory:

    ```bash
    cd AI-Generator
    ```
3. Install dependencies:

    ```bash
    composer install
    ```
    ```bash
    npm install
    ```
    ```bash
    npm run dev
    ```
4. Run server:

    ```bash
    php artisan serve
    ```
## Author
Guido Ezequiel Rosman - 2025
