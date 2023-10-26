from flask import Flask, render_template
app = Flask(__name__)

@app.route("/datadomi/home")
def home():
    return render_template("index.html")

@app.route("/datadomi/rent")
def rent():
    return render_template("Rent.html")

@app.route("/datadomi/addbill")
def add_bill():
    return render_template("addbill.html")

@app.route("/datadomi/addmember")
def add_member():
    return render_template("add-member.html")

@app.route("/datadomi/addroom")
def add_room():
    return render_template("add-room.html")

@app.route("/datadomi/userM")
def user_M():
    return render_template("userM.html")

@app.route("/datadomi/bill")
def bill():
    return render_template("bill.html")

@app.route("/datadomi/adduser")
def add_user():
    return render_template("adduser.html")