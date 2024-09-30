# Generated by Selenium IDE
import pytest
import time
import json
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.support import expected_conditions
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities

class TestFaktorial():
  def setup_method(self, method):
    self.driver = webdriver.Chrome()
    self.vars = {}
  
  def teardown_method(self, method):
    self.driver.quit()
  
  def test_faktorial(self):
    # Test name: faktorial
    # Step # | name | target | value
    # 1 | open | / | 
    self.driver.get("https://qa.putraprima.id/")
    # 2 | setWindowSize | 1064x816 | 
    self.driver.set_window_size(1064, 816)
    # 3 | click | id=input | 
    self.driver.find_element(By.ID, "input").click()
    # 4 | click | css=.card-body | 
    self.driver.find_element(By.CSS_SELECTOR, ".card-body").click()
    # 5 | click | id=input | 
    self.driver.find_element(By.ID, "input").click()
    # 6 | type | id=input | 1
    self.driver.find_element(By.ID, "input").send_keys("1")
    # 7 | click | css=.d-flex | 
    self.driver.find_element(By.CSS_SELECTOR, ".d-flex").click()
    # 8 | click | id=hitung | 
    self.driver.find_element(By.ID, "hitung").click()
    # 9 | click | id=input | 
    self.driver.find_element(By.ID, "input").click()
    # 10 | type | id=input | -0
    self.driver.find_element(By.ID, "input").send_keys("-0")
    # 11 | click | id=hitung | 
    self.driver.find_element(By.ID, "hitung").click()
    # 12 | click | id=input | 
    self.driver.find_element(By.ID, "input").click()
    # 13 | type | id=input | 1,5
    self.driver.find_element(By.ID, "input").send_keys("1,5")
    # 14 | click | id=hitung | 
    self.driver.find_element(By.ID, "hitung").click()
    # 15 | click | id=input | 
    self.driver.find_element(By.ID, "input").click()
    # 16 | type | id=input | 30
    self.driver.find_element(By.ID, "input").send_keys("30")
    # 17 | click | css=html | 
    self.driver.find_element(By.CSS_SELECTOR, "html").click()
  
