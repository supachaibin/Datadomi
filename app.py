# -*- coding: utf-8 -*-
from flask import Flask, render_template, request, jsonify, redirect, url_for, session
import csv
import unicodedata
from datetime import datetime
import os
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


if not os.path.isfile('users.csv'):
    with open('users.csv', 'w', newline='') as csvfile:
        fieldnames = ['Username', 'Password']
        writer = csv.DictWriter(csvfile, fieldnames=fieldnames)
        writer.writeheader()

# Login route
@app.route('/login', methods=['GET', 'POST'])
def login():
    username = request.form['username']
    password = request.form['password']

    # For simplicity, you can consider any login with a non-empty username and password as successful.
    if username and password:
        # Save data to CSV
        with open('users.csv', 'a', newline='') as csvfile:
            fieldnames = ['Username', 'Password']
            writer = csv.DictWriter(csvfile, fieldnames=fieldnames)

            # Write the new user data
            writer.writerow({'Username': username, 'Password': password})

        # Set a session variable upon successful login
        session['username'] = username

        # Redirect to index1.html after successful login
        return redirect(url_for('index1'))
    else:
        # Handle unsuccessful login (you can customize this part based on your requirements)
        return render_template('login.html', message='Login failed. Please try again.')
    

@app.route('/logout')
def logout():
    session.pop('username', None)
    return render_template('login.html')


@app.route('/submit', methods=['POST'])
def submit():
    header1 = request.form['header1']
    header2 = request.form['header2']
    header3 = request.form['header3']
    header4 = request.form['header4']
    header5 = request.form['header5']
    header6 = request.form['header6']
    date = request.form['date']
    try:
        date_obj = datetime.strptime(date, '%Y-%m-%d').date()
    except ValueError:
        date_obj = None  # Handle invalid date format

    data = read_data_from_csv('data.csv')  # Specify the filename as 'data.csv'
    data.append({'b': header1, 'f': header2, 'r': header3, 'n': header4, 'date': date_obj, 'phone': header5, 'bill': header6})
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
        phone_value = normalize_data(data.get('phone'))
        bill_value = normalize_data(data.get('bill'))

        with open('data.csv', 'r', encoding='utf-8', newline='') as csvfile:
            reader = csv.DictReader(csvfile)
            rows = list(reader)

        # Filter out the row to be deleted
        updated_rows = [row for row in rows if normalize_data(row['b']) != b_value or normalize_data(row['f']) != f_value or normalize_data(row['r']) != r_value or normalize_data(row['n']) != n_value or normalize_data(row['phone']) != phone_value or normalize_data(row['bill']) != bill_value]

        # Write the updated rows back to the CSV file
        with open('data.csv', 'w', encoding='utf-8', newline='') as csvfile:
            fieldnames = ['b', 'f', 'r', 'n', 'date', 'phone', 'bill']
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
            fieldnames = ['b', 'f', 'r', 'n', 'date', 'phone', 'bill']
        elif 'newdata.csv' in file_path:
            fieldnames = ['name', 'building', 'floor', 'room', 'bform', 'bforwater', 'bforfire', 'bforrent']
        writer = csv.DictWriter(csvfile, fieldnames=fieldnames)
        writer.writeheader()
        writer.writerows(data)



if __name__ == '__main__':
    app.run(debug=True)
