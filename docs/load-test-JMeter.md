# Load test for Ishtar

load testing for Ishtar site using JMeter

## Test scenario
This test make 20 threads each thread doing the following:


- Get all artist.
- Get all painting.
- Post comment.
- Post artist follow.
- Post painting loved reaction.
- Post painting clap reaction.
- Response 200 assertion. 

## Requirements

- You must have JMeter in your device. Download [ Apache JMeter](http://jmeter.apache.org/download_jmeter.cgi)
- JMeter requires Java, compatible with Java 8 or Java 9

## Usage
- In main repo you will find folder call ishtar-tests insaid it there is folder call load-test-JMeter then you will find two folders one for DB dump, second for testing.
- Use DB dump in "database-dump" folder as database for local testing.

### How to test
- You need to make environment variable call it "JmeterPath" and put path to bin folder as the value. (e.g."C:\apache-jmeter-5.1.1\bin")
- Open "loadtest" folder you will find bat file called "loadtest-ishtar.bat" double click on it.
- Command line will ask you about host name, port number, email and password.
- Command line after test finsh, will tell you where the result path is.

### Note for local testing
dont forget to:
-  Run local site server.
- Start MySQL service.

## Important note
Do not move the bat file out side it's main folder, this could make you lose files in the same directory.