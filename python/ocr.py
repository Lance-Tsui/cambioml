from flask import Blueprint, request, jsonify
import os
import requests
import io
from google.cloud import vision


# 创建一个 Blueprint 对象
ocr = Blueprint('ocr', __name__)

os.environ['GOOGLE_APPLICATION_CREDENTIALS'] = "/home/victsoi/mysite/uwconnect.json"

def download_file(url, local_filename):
    # 发送HTTP GET请求到指定的URL
    response = requests.get(url, stream=True)

    # 确保请求成功
    if response.status_code == 200:
        # 打开本地文件用于写入二进制数据
        with open(local_filename, 'wb') as f:
            for chunk in response.iter_content(chunk_size=8192):
                f.write(chunk)
        return local_filename
    else:
        raise Exception(f"Failed to download file: {response.status_code}")

@ocr.route('/')
def extract():
    filename = request.args.get('filename')
    url = f"http://frc6399.com/test5/uploads/{filename}"
    local_dir = "/home/victsoi/mysite/uploads"
    local_filepath = os.path.join(local_dir, filename)
    download_file(url, local_filepath)

    # 假设有一个进行 OCR 的函数
    result = perform_ocr(local_filepath)

    return jsonify(result)

def perform_ocr(filepath):
    client = vision.ImageAnnotatorClient()

    with io.open(filepath, 'rb') as image_file:
        content = image_file.read()

    image = vision.Image(content=content)
    response = client.document_text_detection(image=image)

    if response.error.message:
        raise Exception(f'Error during image annotation: {response.error.message}')

    texts = response.text_annotations
    extracted_text = texts[0].description if texts else "No text found"

    return {"text": extracted_text}

