from flask import Flask,request,render_template
import numpy as np
import pandas
import sklearn
import pickle

# importing model
model = pickle.load(open('model.pkl','rb'))
sc = pickle.load(open('standscaler.pkl','rb'))
ms = pickle.load(open('minmaxscaler.pkl','rb'))

# creating flask app
app = Flask(__name__)

@app.route('/')
def index():
    return render_template("index.html")
@app.route("/predict", methods=['POST'])
def predict():
    N = float(request.form['Nitrogen'])
    P = float(request.form['Phosporus'])
    K = float(request.form['Potassium'])
    temp = float(request.form['Temperature'])
    humidity = float(request.form['Humidity'])
    ph = float(request.form['Ph'])
    rainfall = float(request.form['Rainfall'])

    feature_list = [N, P, K, temp, humidity, ph, rainfall]
    single_pred = np.array(feature_list).reshape(1, -1)

    scaled_features = ms.transform(single_pred)
    final_features = sc.transform(scaled_features)

    # Get probabilities for all crops
    probabilities = model.predict_proba(final_features)[0]
    crop_classes = model.classes_

    # Get top 3-4 crops based on probability
    top_indices = np.argsort(probabilities)[-4:][::-1]  # top 4 in descending order
    top_crops = [(crop_classes[i], round(probabilities[i]*100, 2)) for i in top_indices]

    result = "Top recommended crops based on your input:<br>"
    result += "<ul>"
    for crop, prob in top_crops:
        result += f"<li><strong>{crop.capitalize()}</strong> — {prob}% suitability</li>"
    result += "</ul>"

    return render_template('index.html', result=result)


# python main
if __name__ == "__main__":
    app.run(debug=True)