from flask import Flask, request, jsonify
import numpy as np
import pickle

# Load the trained model and scalers
model = pickle.load(open('model.pkl', 'rb'))
sc = pickle.load(open('standscaler.pkl', 'rb'))
ms = pickle.load(open('minmaxscaler.pkl', 'rb'))

# Initialize Flask app
app = Flask(__name__)

@app.route('/')
def home():
    return "Crop Recommendation API is Running"

@app.route('/predict', methods=['POST'])
def predict():
    if request.is_json:
        data = request.get_json()
    else:
        return jsonify({"error": "Request must be JSON"}), 400

    try:
        # Extract and convert input data
        N = float(data['Nitrogen'])
        P = float(data['Phosporus'])
        K = float(data['Potassium'])
        temp = float(data['Temperature'])
        humidity = float(data['Humidity'])
        ph = float(data['Ph'])
        rainfall = float(data['Rainfall'])

        # Prepare features
        feature_list = [N, P, K, temp, humidity, ph, rainfall]
        single_pred = np.array(feature_list).reshape(1, -1)

        # Scale features
        scaled_features = ms.transform(single_pred)
        final_features = sc.transform(scaled_features)

        # Get prediction probabilities
        probabilities = model.predict_proba(final_features)[0]
        crop_classes = model.classes_

        # Get top 4 crops by probability
        top_indices = np.argsort(probabilities)[-4:][::-1]
        top_crops = [
            {"crop": crop_classes[i].capitalize(), "probability": round(probabilities[i] * 100, 2)}
            for i in top_indices
        ]

        return jsonify({"recommendations": top_crops})

    except Exception as e:
        return jsonify({"error": str(e)}), 500

# Run the app
if __name__ == '__main__':
    app.run(debug=True)
