<div id="top"></div>

<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]



<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/codebarbarian/CertMon">
    <img src="images/logo.png" alt="Logo" width="80" height="80">
  </a>

<h3 align="center">CertMon</h3>

  <p align="center">
    CertMon is your go to Certificate Monitoring for all your needs! 
    <br />
    <a href="https://github.com/codebarbarian/CertMon"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/codebarbarian/CertMon">View Demo</a>
    ·
    <a href="https://github.com/codebarbarian/CertMon/issues">Report Bug</a>
    ·
    <a href="https://github.com/codebarbarian/CertMon/issues">Request Feature</a>
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

CertMon is your lightweight Certificate Monitoring tool. Built using the Metamorphosis PHP Framework ensures low foot print and ease of use if you wish to extend the functionality of the application.

CertMon uses a file based approach instead of relying on a database, this makes managing certificates way easier.

All the certificates will be stored in the certificate directory inside ````./src/public/certificates````.

<p align="right">(<a href="#top">back to top</a>)</p>



### Built With

* [PHP](https://www.php.net/)
* [Metamorphosis PHP Framework](https://github.com/codebarbarian/metamorphosis)

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- GETTING STARTED -->
## Getting Started

1. Clone this repository ```git clone https://github.com/CodeBarbarian/CertMon.git .```
2. Install docker, docker-compose
3. Do the required changes to the docker-compose file
4. Run ```docker-compose up -d```
5. You should now be up and running!?

### Prerequisites

* Docker
* docker-compose
* git

### Installation

1. Clone this repository ```git clone https://github.com/CodeBarbarian/CertMon.git .```
2. Install docker, docker-compose
3. Do the required changes to the docker-compose file
4. Run ```docker-compose up -d```
5. You should now be up and running!?

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- USAGE EXAMPLES -->
## Usage

### Development
````yaml
version: '3.9'
services:
  certmon-server:
    container_name: certmon-server
    image: codebarbarian/certmon-server:latest
    volumes:
      - ./src:/var/www/html/
    ports:
      - 80:80
  certmon-cron-dev:
    container_name: certmon-cron-dev
    image: codebarbarian/certmon-cron-dev:latest
````

### Every 12 Hours
````yaml
version: '3.9'
services:
  certmon-server:
    container_name: certmon-server
    image: codebarbarian/certmon-server:latest
    volumes:
      - ./src:/var/www/html/
    ports:
      - 80:80
  certmon-cron-12:
    container_name: certmon-cron-12
    image: codebarbarian/certmon-cron-12:latest
````

### Every 24 Hours
````yaml
version: '3.9'
services:
  certmon-server:
    container_name: certmon-server
    image: codebarbarian/certmon-server:latest
    volumes:
      - ./src:/var/www/html/
    ports:
      - 80:80
  certmon-cron-24:
    container_name: certmon-cron-24
    image: codebarbarian/certmon-cron-24:latest
````

### Making local changes to the individual Dockerfiles for local changes: 
* Just make any change you feel like, build the images and point either the context (build) or publish your own version of the images to [Docker Hub](https://hub.docker.com/).

<p align="right">(<a href="#top">back to top</a>)</p>


<!-- ROADMAP -->
## Roadmap

See the [open issues](https://github.com/codebarbarian/CertMon/issues) for a full list of proposed features (and known issues).

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTACT -->
## Contact

Morten Haugstad - [@codebarbarian](https://twitter.com/codebarbarian)

Project Link: [https://github.com/codebarbarian/CertMon](https://github.com/codebarbarian/CertMon)

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/codebarbarian/CertMon.svg?style=for-the-badge
[contributors-url]: https://github.com/codebarbarian/CertMon/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/codebarbarian/CertMon.svg?style=for-the-badge
[forks-url]: https://github.com/codebarbarian/CertMon/network/members
[stars-shield]: https://img.shields.io/github/stars/codebarbarian/CertMon.svg?style=for-the-badge
[stars-url]: https://github.com/codebarbarian/CertMon/stargazers
[issues-shield]: https://img.shields.io/github/issues/codebarbarian/CertMon.svg?style=for-the-badge
[issues-url]: https://github.com/codebarbarian/CertMon/issues
[license-shield]: https://img.shields.io/github/license/codebarbarian/CertMon.svg?style=for-the-badge
[license-url]: https://github.com/codebarbarian/CertMon/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/mortenhaugstad
[product-screenshot]: images/logo.png
