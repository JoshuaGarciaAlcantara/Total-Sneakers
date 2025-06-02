import smtplib
import sys
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

# we have taken this of php that's crazy dude
user = sys.argv[1]
email = sys.argv[2]
user_msg = sys.argv[3]

#my config app password
gmail_user = 'joshua2.garciaalcantara@gmail.com'          # Cambiar
gmail_password = 'mujr ssoh guhm jaad'     # Cambiar

# The message
msg = MIMEMultipart()
msg['From'] = gmail_user
msg['To'] = email
msg['Subject'] = f'THANKS FOR TESTING OUR PROGRAM {user}'

body = f'Hi {user} glad to say hello to you, we are junior developers in their first programming first steps and we are really glad to trust us your confidence. Idk, but we are so happy that this script works.\n\n So I just can say thanks thanks thanks thanks a lot. \n\nOh and I almost forget it, here is your msg: {user_msg}'
msg.attach(MIMEText(body, 'plain'))

try:
    server = smtplib.SMTP('smtp.gmail.com', 587)
    server.starttls()
    server.login(gmail_user, gmail_password)
    server.sendmail(gmail_user, gmail_user, msg.as_string())
    server.quit()
    print("ENVIADO")
except Exception as e:
    print(f"ERROR: {e}")
