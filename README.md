
# Document Management System (DMS)

## Overview
A Document Management System (DMS) developed using the PHP Yii2 framework, designed to store, organize, manage, and track electronic documents and files. The system provides a centralized repository for storing and accessing documents, streamlining document-related processes.

## Features
1. **Document Storage**: Store electronic documents including text files, spreadsheets, presentations, images, and videos.
2. **Version Control**: Track document changes and maintain version history.
3. **Document Indexing and Search**: Robust search capabilities to locate documents based on keywords or metadata.
4. **Access Control and Security**: Ensure only authorized individuals can view, edit, or delete documents.
5. **Collaboration**: Enable real-time editing and document sharing with multiple users.
6. **Workflow Automation**: Automate document approval processes and notifications.
7. **Integration**: Integrates with CRM, ERP, and project management tools.
8. **Audit Trail**: Maintain a detailed record of document access and changes.
9. **Scanning and Capture**: Convert physical documents into digital format using OCR.
10. **Retention and Archiving**: Automate document archiving and deletion based on policies.

## Benefits
1. Improved organization and retrieval of documents.
2. Enhanced collaboration with remote teams.
3. Time and cost savings with efficient document management.
4. Compliance with security and regulatory standards.
5. Disaster recovery and centralized backup solution.
6. Supports remote work with cloud-based document access.

## Technologies
- **Framework**: Yii2 (PHP)
- **Database**: MySQL
- **Frontend**: Bootstrap 5
- **Backend**: PHP 8.x, Yii2
- **Other**: CURL, JWT, OCR

## API Usage Example
Here is an example of uploading a file via API using cURL in PHP:

```php
<?php
$apiEndpoint = 'https://example.com/upload';
$apiKey = 'YOUR_API_KEY';
$filePath = 'file.pdf';

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'file' => new CURLFile($filePath)
]);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey
]);

// Execute cURL session and capture the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    // Handle the API response
    echo 'API Response: ' . $response;
}

// Close cURL session
curl_close($ch);
?>
```

## Installation and Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/cpjeslot/file-management-system.git
   ```

2. Install dependencies using Composer:
   ```bash
   composer install
   ```

3. Run the application:
   ```bash
   php yii serve
   ```

## License
This project is licensed under the MIT License. See the LICENSE file for more details.
