# Google Sheets Integration Setup

## Step 1: Create Google Apps Script Web App

1. Go to [Google Apps Script](https://script.google.com/)
2. Click "New Project"
3. Replace the default code with the content from `google_apps_script.js`
4. Save the project (give it a name like "Form to Sheets")
5. Click "Deploy" → "New Deployment"
6. Choose type: "Web app"
7. Set execute as: "Me"
8. Set access: "Anyone"
9. Click "Deploy"
10. Copy the Web App URL that appears

## Step 2: Update PHP File

1. Open `send_to_sheets.php`
2. Replace `YOUR_GOOGLE_APPS_SCRIPT_WEB_APP_URL` with the URL you copied from step 1

## Step 3: Test

1. Open `index.html` in your browser
2. Fill out the form with test data
3. Submit the form
4. Check your Google Sheet - it should have:
   - Column headers: Name, Age, ID, Date
   - Your test data in the first row below headers
   - Current date/time in the Date column

## Your Google Sheet

The data will be sent to: https://docs.google.com/spreadsheets/d/1k-HTOvsfNptnB6_vAkjTgHtP-5ockv542GVdQKat-zk/edit

## Troubleshooting

- Make sure your Google Sheet is accessible
- Ensure the Google Apps Script Web App is deployed with "Anyone" access
- Check that cURL is enabled on your PHP server