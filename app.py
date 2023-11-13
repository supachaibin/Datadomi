# Import necessary libraries
from flask import Flask, render_template, request, jsonify
import csv
import unicodedata

app = Flask(__name__)

# Define the main page route
@app.route('/')
def index():
    # Get the 'submitted' query parameter from the URL
    submitted = request.args.get('submitted')
    return render_template('index.html', submitted=submitted)

# Define a route to display data from the CSV file
@app.route('/index2')
def index2():
    data = read_data_from_csv()
    return render_template('index2.html', data=data)

# Define a route to submit data to the CSV file
@app.route('/submit', methods=['POST'])
def submit():
    header1 = request.form['header1']
    header2 = request.form['header2']
    header3 = request.form['header3']
    header4 = request.form['header4']

    data = read_data_from_csv()
    data.append({'b': header1, 'f': header2, 'r': header3, 'n': header4})
    write_data_to_csv(data)

    return jsonify({'status': 'success'})

# Define a route to delete a row from the CSV file
@app.route('/delete_row', methods=['POST'])
def delete_row():
    try:
        data = request.get_json()
        b_value = normalize_data(data.get('b'))
        f_value = normalize_data(data.get('f'))
        r_value = normalize_data(data.get('r'))
        n_value = normalize_data(data.get('n'))

        data = read_data_from_csv()
        updated_data = [row for row in data if (
            normalize_data(row['b']) != b_value or
            normalize_data(row['f']) != f_value or
            normalize_data(row['r']) != r_value or
            normalize_data(row['n']) != n_value
        )]

        write_data_to_csv(updated_data)

        return jsonify(success=True)
    except Exception as e:
        print(e)
        return jsonify(success=False)

# Function to normalize data using NFC Unicode normalization
def normalize_data(input_data):
    return unicodedata.normalize('NFC', input_data)

# Function to read data from the CSV file
def read_data_from_csv():
    data = []
    with open('data.csv', 'r', encoding='utf-8') as csvfile:
        csv_reader = csv.DictReader(csvfile)
        for row in csv_reader:
            data.append(row)
    return data

# Function to write data to the CSV file
def write_data_to_csv(data):
    try:
        with open('data.csv', 'w', encoding='utf-8', newline='') as csvfile:
            fieldnames = ['b', 'f', 'r', 'n']
            writer = csv.DictWriter(csvfile, fieldnames=fieldnames)
            writer.writeheader()
            writer.writerows(data)
    except Exception as e:
        print("Error writing data to CSV:", e)


if __name__ == '__main__':
    app.run(debug=True)
