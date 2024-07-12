frontend: python
used pythonanywhere.com to deploy
python version: 3.10
framework: flask
library requirements: flask, ocr, google.cloud
structure:
- flask_app.py
- ocr.py
- uwconnect.json (credential file)

backend: php
please use a web hosting plan to host it
structure:
- index.php
- upload.php
- app.js
- style.css
- uploads (folder)

credential: uwconnect.json

after you enabled google vision api key, the credential is under project settings -> service accounts (it's not OAuth2.0)

Steps:

- Go to Google Cloud Console

- Enable Google Cloud Vision API

- Go to IAM and Admin -> Service Accounts

- Create a key and download the json file, and put it into the python folder

potential development: mongodb

will use mongodb atlas for db hosting

mongodb provides string for both python and php

will use python to insert records to mongodb
