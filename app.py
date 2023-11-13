# -*- coding: utf-8 -*-
from flask import Flask, render_template, request, jsonify, redirect, url_for, session
import csv
import unicodedata
from datetime import datetime

app = Flask(__name__)
app.secret_key = 'your_secret_key'  # Replace with a secure secret key

@app.route('/')
def index():
    return render_template('login.html')

@app.route('/index1')
def index1():
    submitted = request.args.get('submitted')
    return render_template('index1.html', submitted=submitted)

@app.route('/index2')
def index2():
    data = read_data_from_csv('data.csv')  # Specify the filename as 'data.csv'
    return render_template('index2.html', data=data)

@app.route('/login', methods=['POST'])
def process_login():
    username = request.form['username']
    password = request.form['password']

    # For simplicity, you can consider any login with a non-empty username and password as successful.
    if username and password:
        # Save data to CSV
        with open('users.csv', 'a', newline='') as csvfile:
            fieldnames = ['Username', 'Password']
            writer = csv.DictWriter(csvfile, fieldnames=fieldnames)

            # Check if the CSV file is empty and write header if needed
            if csvfile.tell() == 0:
                writer.writeheader()

            # Write the new user data
            writer.writerow({'Username': username, 'Password': password})

        # Redirect to index1.html after successful login
        return redirect(url_for('index1'))
    else:
        # Handle unsuccessful login (you can customize this part based on your requirements)
        return render_template('login.html', message='Login failed. Please try again.')

@app.route('/submit', methods=['POST'])
def submit():
    header1 = request.form['header1']
    header2 = request.form['header2']
    header3 = request.form['header3']
    header4 = request.form['header4']
    date = request.form['date']
    try:
        date_obj = datetime.strptime(date, '%Y-%m-%d').date()
    except ValueError:
        date_obj = None  # Handle invalid date format

    data = read_data_from_csv('data.csv')  # Specify the filename as 'data.csv'
    data.append({'b': header1, 'f': header2, 'r': header3, 'n': header4, 'date': date_obj})
    write_data_to_csv(data, 'data.csv')  # Specify the filename as 'data.csv'

    return jsonify({'status': 'success'})

@app.route('/delete_row', methods=['POST'])
def delete_row():
    try:
        data = request.get_json()
        b_value = normalize_data(data.get('b'))
        f_value = normalize_data(data.get('f'))
        r_value = normalize_data(data.get('r'))
        n_value = normalize_data(data.get('n'))

        with open('data.csv', 'r', encoding='utf-8', newline='') as csvfile:
            reader = csv.DictReader(csvfile)
            rows = list(reader)

        # Filter out the row to be deleted
        updated_rows = [row for row in rows if normalize_data(row['b']) != b_value or normalize_data(row['f']) != f_value or normalize_data(row['r']) != r_value or normalize_data(row['n']) != n_value]

        # Write the updated rows back to the CSV file
        with open('data.csv', 'w', encoding='utf-8', newline='') as csvfile:
            fieldnames = ['b', 'f', 'r', 'n', 'date']
            writer = csv.DictWriter(csvfile, fieldnames=fieldnames)
            writer.writeheader()
            writer.writerows(updated_rows)

        response = {'success': True, 'message': 'Row deleted successfully'}
        return jsonify(response)
    except Exception as e:
        print(e)
        # Return a failure message
        response = {'success': False, 'message': 'Error deleting row'}
        return jsonify(response)

def normalize_data(input_data):
    return unicodedata.normalize('NFC', input_data)

def read_data_from_csv(file_path):
    data = []
    with open(file_path, 'r', encoding='utf-8') as csvfile:
        csv_reader = csv.DictReader(csvfile)
        for row in csv_reader:
            data.append(row)
    return data

def write_data_to_csv(data, file_path):
    with open(file_path, 'w', encoding='utf-8', newline='') as csvfile:
        if 'data.csv' in file_path:
            fieldnames = ['b', 'f', 'r', 'n', 'date']
        elif 'newdata.csv' in file_path:
            fieldnames = ['name', 'building', 'floor', 'room', 'bform', 'bforwater', 'bforfire', 'bforrent']
        writer = csv.DictWriter(csvfile, fieldnames=fieldnames)
        writer.writeheader()
        writer.writerows(data)

@app.route('/logout')
def logout():
    # Clear the user's session
    session.clear()
    # Redirect to the login page (replace 'login' with the actual login route)
    return redirect(url_for('login'))

if __name__ == '__main__':
    app.run(debug=True)
