# Automatic MySQL Database Backup to Google Drive

## 01 Repo Structure


```
    ├── docs                                   # Contains documents  
    ├── research                               # Contains pre-research. 
    ├── source                                 # Contains project source code.
    │   ├── main.php                               # Main app file.
    └── README.MD                              # Readme Content.
    └── LICENSE.MD                             # LICENSE of the project.
```

## 02 Introduction

This repository contains a PHP script designed for automating MySQL database backups from a hosting server to Google Drive. The script utilizes cron jobs to schedule regular backups, ensuring data integrity and availability. Backups are securely transferred to Google Drive for safekeeping and can be configured to delete older backups to manage storage efficiently.

### Key Features:

- Automated Backup: Schedule backups at regular intervals using cron jobs.
- Secure Transfer: Safely transfer backups to Google Drive using OAuth for authentication.
- Storage Management: Option to delete older backups to optimize storage usage.
- Customizable: Easily configure backup settings and schedule as per your requirements.
Usage:

![Banner](docs/media/0-banner-image.png)


## 03 Technology Stack

- PHP
- Python
- google-apiclient:^2.0

## 04 Setup

- **Step 01:** Enable Google Drive API

    - Go to the Google Cloud Console.
    - Create a new project or select an existing project.
    - Enable the Google Drive API.

- ![Banner](docs/media/1-enable-google-drive-api.png)


- **Step 02:** Create a service account

    - Navigate to IAM & Admin > Service accounts.
    - Fill in the Service Account Details.
    - Create and Download a JSON Key File.
    - Use the Service Account using JSON Key.

- ![Banner](docs/media/2-create-a-service-account.png)


- **Step 03:** Create and save JSON Auth Key

    - Navigate to Service accounts > Keys.
    - Select JSON Key and save it (This key is used for authentication purpose).

- **Step 04:** Create a folder in Google Drive and share it to service account mail

    - Service Account Mail

    - ![Banner](docs/media/4-service-account-mail.png)

    - Share the destination folder to Service Account Mail

    - ![Banner](docs/media/5-share-to-service-account-mail.png)


- **Step 05:** Deploy the script to the server

    - ![Banner](docs/media/6-deploy-the-script-to-the-server.png)


- **Step 06:** Install google-apiclient:^2.0 using composer through SSH

    ```
        composer require google/apiclient:^2.0
    ```

- **Step 07:** Hook up this script with cron schedular in the Server

    - ![Banner](docs/media/7-hook-up-cron-job.png)



## 5.2 Output

![Output](docs/media/8-output.png)

# Contact

### Website: 

[![Visit](https://img.shields.io/badge/Visit%3A%20www.gunarakulan.info-%23E01E5A?style=flat&logo=realm&logoColor=white)](https://www.gunarakulan.info)

### Social Media:

[![LinkedIn](https://img.shields.io/badge/-LinkedIn-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/gunarakulangunaretnam)
[![Facebook](https://img.shields.io/badge/-Facebook-196dcc?style=for-the-badge&logo=facebook&logoColor=white)](https://www.facebook.com/gunarakulangunaretnam)
[![WhatsApp](https://img.shields.io/badge/-WhatsApp-07a647?style=for-the-badge&logo=whatsapp&logoColor=white)](https://wa.me/94740001141?text=WhatsApp%3A%20%2B9740001141)
[![Instagram](https://img.shields.io/badge/-Instagram-bd3651?style=for-the-badge&logo=instagram&logoColor=white)](https://www.instagram.com/gunarakulangunaretnam)
[![X.COM](https://img.shields.io/badge/-X.COM-0066ff?style=for-the-badge&logo=x&logoColor=white)](https://x.com/gunarakulangr)
[![Kaggle](https://img.shields.io/badge/-Kaggle-3295bd?style=for-the-badge&logo=kaggle&logoColor=white)](https://www.kaggle.com/gunarakulangr)
[![TikTok](https://img.shields.io/badge/-TikTok-579ea3?style=for-the-badge&logo=tiktok&logoColor=white)](https://www.tiktok.com/@gunarakulangunaretnam)
[![YouTube](https://img.shields.io/badge/-YouTube-a82121?style=for-the-badge&logo=youtube&logoColor=white)](https://www.youtube.com/channel/UCjMOdgHFAjAdBKiqV8y2Tww)
