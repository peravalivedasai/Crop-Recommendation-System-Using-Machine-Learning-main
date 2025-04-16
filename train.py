import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler, MinMaxScaler
from sklearn.ensemble import RandomForestClassifier
import pickle

# Load dataset
data = pd.read_csv("Crop_recommendation.csv")

# Features and labels
X = data.drop("label", axis=1)
y = data["label"]

# Scaling
ms = MinMaxScaler()
X_minmax = ms.fit_transform(X)

sc = StandardScaler()
X_scaled = sc.fit_transform(X_minmax)

# Train/Test split
X_train, X_test, y_train, y_test = train_test_split(X_scaled, y, test_size=0.2, random_state=42)

# Train the model
model = RandomForestClassifier()
model.fit(X_train, y_train)

# Save everything
pickle.dump(model, open("model.pkl", "wb"))
pickle.dump(ms, open("minmaxscaler.pkl", "wb"))
pickle.dump(sc, open("standscaler.pkl", "wb"))

print("Training complete. Model and scalers saved!")
