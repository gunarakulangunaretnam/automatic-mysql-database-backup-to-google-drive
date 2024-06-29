from google.oauth2 import service_account
from googleapiclient.discovery import build
from googleapiclient.http import MediaFileUpload

# Path to the JSON file containing service account credentials
SERVICE_ACCOUNT_FILE = 'ADD_SERVICE_ACCOUNT_AUTH_KEY.json'

# ID of the Google Drive folder where you want to upload the file
DRIVE_FOLDER_ID = 'ADD_GOOGLE_DRIVE_FOLDER_ID'

def upload_file(file_path):
    credentials = service_account.Credentials.from_service_account_file(
        SERVICE_ACCOUNT_FILE,
        scopes=['https://www.googleapis.com/auth/drive']
    )

    service = build('drive', 'v3', credentials=credentials)

    file_metadata = {
        'name': 'example_file.txt',  # Name of the file in Google Drive
        'parents': [DRIVE_FOLDER_ID]  # ID of the folder in Google Drive
    }
    media = MediaFileUpload(file_path, resumable=True)

    file = service.files().create(
        body=file_metadata,
        media_body=media,
        fields='id'
    ).execute()

    print(f"File uploaded successfully. File ID: {file.get('id')}")

# Example usage
if __name__ == '__main__':
    upload_file('example_file.txt')
