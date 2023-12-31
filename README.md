# <img src="https://i.imgur.com/lPtkKoH.png" width="40"> Alpha 2

## Description

This is the second alpha project.
It is a website that allows the user to upload a text file and then shorten it.
The processing is done by a backend written
in <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/2560px-PHP-logo.svg.png" width="40">.
The website is written
in <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/38/HTML5_Badge.svg/800px-HTML5_Badge.svg.png" width="20">,
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/62/CSS3_logo.svg/1024px-CSS3_logo.svg.png" width="20">
and <img src="https://iconape.com/wp-content/png_logo_vector/javascript-logo.png" width="18">.

This project was made by [Matyas Zavora](https://www.linkedin.com/in/matyas-zavora/)

### Prerequisites

- [<u><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Xampp_logo.svg/2560px-Xampp_logo.svg.png" width="80"></u>](https://www.apachefriends.org/index.html) (
  or any other web server)
- [<u><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/2560px-PHP-logo.svg.png" width="40"></u>](https://www.php.net/downloads.php)
  7.4 (or higher)
- A web browser
- A text file to shorten
- (Optional) Access to the internet (
  for <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Bootstrap_logo.svg/2560px-Bootstrap_logo.svg.png" width="24">)

## Installation

#### Windows

1.

Open <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Xampp_logo.svg/2560px-Xampp_logo.svg.png" width="80">
or any other web server

2. Clone this repository into the `htdocs` folder
   of <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Xampp_logo.svg/2560px-Xampp_logo.svg.png" width="80">
3.

Start <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Xampp_logo.svg/2560px-Xampp_logo.svg.png" width="80"> (
Apache should be enough) (default port is 80)

4. Open `localhost[:port]/alpha2` in your browser

#### Linux

1. Clone this repository into `/var/www/html`
2. Start Apache (default port is 80)
3. Open `localhost[:port]/alpha2` in your browser

If you get a permission error, run `sudo chmod -R 777 /var/www/html/alpha2`
and `sudo chown -R www-data:www-data /var/www/html/alpha2`.
This will give the web server full access to the folder.

## Usage

1. Open the website in your browser (see [Installation](#installation))
2. Click on the `Choose file` button
3. Select a text file
4. Fill out The mighty table of shortages
5. (Optional) Change the name of the output file
6. Click on the `Submit` button
7. Wait for the website to process the file
8. Select a location to save the processed file
9. Click on the `Save` button

### Example

#### Input

```
Lorem ipsum dolor sit amet.
```

#### The mighty table of shortages

| Shortage | Replacement |
|----------|-------------|
| Lorem    | L           |
| ipsum    | i           |
| dolor    | d           |
| sit      | s           |
| amet     | a           |

#### Output

```
L i d s a.
```

## TODO

### Meta

- [ ] Write `README.md`
- [ ] Turn assignment in on Moodle in time
- [ ] Make sure everything works
- [ ] Make sure everything is commented
- [ ] Make sure everything is documented

### Frontend

- [ ] Change assignment button placement
- [ ] Make file input accept only text files
- [ ] Change style of file input
- [ ] Make submit button appear only when file is uploaded
- [ ] Change button style (add more space in between)
- [ ] Implement text input for name of output file

### Backend

- [ ] Make submit button work
- [ ] Make file input work
- [ ] Make text input work (name of output file)
- [ ] Output processed file (website starts downloading it)