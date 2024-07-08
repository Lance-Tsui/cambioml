
# A very simple Flask Hello World app for you to get started with...

from flask import Flask
from ocr import ocr

app = Flask(__name__)
app.register_blueprint(ocr, url_prefix='/ocr')

@app.route('/')
def hello_world():
    return 'Hello from Flask!'



