from flask import Flask, request, jsonify
from tensorflow.keras.models import load_model
import numpy as np
from sklearn.preprocessing import LabelEncoder

app = Flask(__name__)

# Load your trained model
model = load_model('initialtestclassifier3.h5')

# Initialize the label encoder and fit it with the expected labels
label_encoder = LabelEncoder()
labels = ['Poor', 'Average', 'Good', 'Excellent']  # Example labels, replace with your actual labels
label_encoder.fit(labels)

@app.route('/predict', methods=['POST'])
def predict():
    try:
        data = request.json
        
        # Extract GPA and initial test scores from JSON data
        gpa = float(data.get('gpa'))
        initialtest1_score = float(data.get('initialtest1_score'))
        initialtest2_score = float(data.get('initialtest2_score'))
        initialtest3_score = float(data.get('initialtest3_score'))
        
        # Prepare input data
        input_data = np.array([gpa, initialtest1_score, initialtest2_score, initialtest3_score]).reshape(1, -1)
        
        # Log the input data
        #print(f'Input Data: {input_data}')
        
        # Make prediction
        prediction = model.predict(input_data)
        predicted_performance = label_encoder.inverse_transform([np.argmax(prediction)])
       
        # Log the model's output
        print(f'Model Prediction: {prediction}')
        
        return jsonify({'prediction': predicted_performance[0]})
    except Exception as e:
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
