# dr4kul4
A simple Subdomain Enumeration using `crt.sh` with a nice Static Web Interface. This tool allows you to quickly and easily enumerate subdomains of a given domain using the crt.sh. The tool is built with a simple and clean user interface that makes it easy to use.

> You can also check out [crtiflux.js](https://github.com/sc4rfurry/crtiflux.js) for a `javascript` version of this tool and visit [crtiflux](https://sc4rfurry.github.io/crtiflux.js) for a live Application. 

# Features
- Quick and easy subdomain enumeration
- User-friendly interface
- Randomized User-Agent
- Secure with error handling

# Pre-Requirements
- Php `(Version: 8.1.2-1ubuntu2.9)`
- php-curl
> sudo apt-get install php-curl `(for Ubuntu Based Distros)`

- php -m | grep curl
- Server (Python/Php/Xampp/Apache2)

# Getting Started

+ Clone the repository 
+ Copy code
`git clone https://github.com/sc4rfurry/dr4kul4.git`
+ Start your server (Xampp/Apache2)
+ Open the index.html file in your browser `http://Server_Ip:Server_Port`
+ Enter the domain you want to enumerate
+ Click on Scan button
+ Wait for the scan to complete
+ The results will be displayed on the screen

# Limitations
> The tool is dependent on crt.sh, which means that the results may be limited by the crt.sh's database.

# Security
> The tool is designed to be secure and to handle errors and exceptions. The tool makes use of randomized User-Agent for every new request and also sets security headers.

# Contributions
We welcome contributions from the community. If you wish to contribute, please fork the repository and submit a pull request.

# Disclaimer
This tool is for educational and ethical testing purposes only. Do not use it for illegal activities or without obtaining proper authorization. The authors are not responsible for any misuse or damage caused by this tool.

# License
> This project is licensed under the MIT License - see the LICENSE file for details.

# Acknowledgements
- crt.sh for providing the API
- Materialize for providing the CSS framework
- jQuery for making JavaScript easy.