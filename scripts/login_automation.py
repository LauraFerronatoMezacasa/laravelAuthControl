from selenium import webdriver
from selenium.webdriver.common.by import By
import time
import random

def type_with_delay(element, text, delay=0.1):
    for char in text:
        element.send_keys(char)
        time.sleep(delay) 

def login_to_application(url, username, password):
    driver = webdriver.Chrome() 

    driver.get(url)

    time.sleep(1)

    username_field = driver.find_element(By.NAME, 'email')
    password_field = driver.find_element(By.NAME, 'password') 

    type_with_delay(username_field, username)
    type_with_delay(password_field, password)

    login_button = driver.find_element(By.XPATH, '//button[@type="submit"]')
    login_button.click()

    time.sleep(3)

    driver.quit()

if __name__ == "__main__":
    url = 'http://localhost:8000/login'
    username = 'admin@example.com'
    password = 'GYN^%IY(lNy&;Vt'

    login_to_application(url, username, password)