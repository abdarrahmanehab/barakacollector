// Google Apps Script to receive form data and write to spreadsheet
// Deploy this as a Web App in Google Apps Script

// ===== START COPY =====
function doPost(e) {
  try {
    // Your Google Sheets ID (extracted from the URL you provided)
    var sheetId = '1k-HTOvsfNptnB6_vAkjTgHtP-5ockv542GVdQKat-zk';
    var sheet = SpreadsheetApp.openById(sheetId).getActiveSheet();

    // Get form data
    var name = e.parameter.name;
    var phone = e.parameter.phone;
    var question = e.parameter.question;
    var date = e.parameter.date;

    // Check if headers exist, if not create them
    var lastRow = sheet.getLastRow();
    if (lastRow === 0) {
      // Add headers
      sheet.getRange(1, 1, 1, 4).setValues([['Name', 'Phone', 'Question/Note', 'Date']]);

      // Set column widths for better display
      sheet.setColumnWidth(1, 200); // Name (wider)
      sheet.setColumnWidth(2, 150); // Phone
      sheet.setColumnWidth(3, 400); // Question (much wider for text)
      sheet.setColumnWidth(4, 180); // Date

      // Format headers
      var headerRange = sheet.getRange(1, 1, 1, 4);
      headerRange.setFontWeight('bold');
      headerRange.setBackground('#4CAF50');
      headerRange.setFontColor('white');

      lastRow = 1;
    }

    // Add the new data in the next row
    var dataRange = sheet.getRange(lastRow + 1, 1, 1, 4);
    dataRange.setValues([[name, phone, question, date]]);

    // Format the question cell to wrap text and merge if needed for long text
    var questionCell = sheet.getRange(lastRow + 1, 3);
    questionCell.setWrap(true);
    questionCell.setVerticalAlignment('top');

    // If question is long (more than 100 characters), make the row taller
    if (question && question.length > 100) {
      sheet.setRowHeight(lastRow + 1, 60);
    }

    return ContentService.createTextOutput('Success');

  } catch (error) {
    return ContentService.createTextOutput('Error: ' + error.toString());
  }
}

function doGet(e) {
  return ContentService.createTextOutput('Web App is running');
}
// ===== END COPY =====