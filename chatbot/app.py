from flask import Flask, request, jsonify
from flask_cors import CORS
import pymysql

app = Flask(__name__)
CORS(app)

# MySQL connection setup
def get_db_connection():
    connection = pymysql.connect(
        host='localhost',  # Update with your database host
        user='root',  # Your MySQL username
        password='',  # Your MySQL password
        db='orphan',  # Database name
        charset='utf8mb4',
        cursorclass=pymysql.cursors.DictCursor
    )
    return connection

@app.route('/chat', methods=['POST'])
def chat():
    data = request.get_json()
    user_message = data.get("message", "").lower()
    print(f"Received from user: {user_message}")  # Debug print

    # Basic response logic (you can make it smarter later)
    if "donate" in user_message:
        response = "You can donate through our official donation page or contact our NGO directly. 😊"
    elif "volunteer" in user_message:
        response = "Thank you for your interest in volunteering! Please fill out the volunteer form on our website."
    elif "event" in user_message:
        response = get_upcoming_events()
    elif "child" in user_message:
        response = get_child_details()
    elif "contact" in user_message:
        response = "You can contact us at contact@cherrishhomes.com or just give us a response in our feedback form."
    else:
        response = f"I'm here to help, but I didn't quite get that. Can you please ask something else?"

    return jsonify({"response": response})

def get_upcoming_events():
    try:
        connection = get_db_connection()
        with connection.cursor() as cursor:
            cursor.execute("SELECT title, start, end, description FROM events WHERE start > NOW() ORDER BY start ASC LIMIT 5")
            events = cursor.fetchall()
            if events:
                event_list = "\n\n".join([
                    f"📌 *{event['title']}*\n🗓️ Date: {event['start']} to {event['end']}\n📝 Description: {event['description']}"
                    for event in events
                ])
                return f"Here are some upcoming events:\n\n{event_list}"
            else:
                return "No upcoming events at the moment."
    except Exception as e:
        return f"⚠️ Error fetching events: {str(e)}"
    finally:
        connection.close()


def get_child_details():
    try:
        connection = get_db_connection()
        with connection.cursor() as cursor:
            cursor.execute("SELECT cname, cdob, cyoe, cclass, cstory, sponsored, interests FROM children WHERE sponsored = 'no' LIMIT 5")
            children = cursor.fetchall()
            if children:
                child_list = "\n\n".join([
                f"🧒 *{child['cname']}*\n📅 Date of Birth: {child['cdob']}\n📌 Year of Entry: {child['cyoe']}\n🏫 Class: {child['cclass']}\n💬 Story: {child['cstory']}\n🎯 Interests: {child['interests']}"
                for child in children
            ])

                return f"Here are some children available for adoption:\n\n{child_list}"
            else:
                return "No children available for adoption at the moment."
    except Exception as e:
        return f"⚠️ Error fetching child details: {str(e)}"
    finally:
        connection.close()


if __name__ == '__main__':
    app.run(debug=True)
