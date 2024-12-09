<h1 align="center">🗳️ Voting System 🗳️</h1>

<p align="center">
   A robust voting system built with Laravel. 
</p>

---

## 📦 Installation

### 🔧 Requirements

Ensure your system meets the [Laravel Server Requirements](https://laravel.com/docs/10.x/deployment#server-requirements).  

---

### 🌀 Clone the Repository

Run the following command to clone the repository into your desired directory:
```bash
git clone https://github.com/temur0212/Voting_system.git [YourDirectoryName]
```


### ⚙️ Install PHP Dependencies

Move into the project directory and install all required PHP dependencies:
```bash
cd YourDirectoryName
composer install
```

### 🛠️ Configuration


1. Create `.env`  file
 Copy the `.env.example` file to `.env`:
``` bash
cp .env.example .env
```


2.Generate Application Key
Run the following command to generate the app key:
``` bash
php artisan key:generate
```


3. Set Database Credentials
Open the .env file and update the database configuration as follows:
``` bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

4. Write them in the .env file to configure signing in with Google:
```bash
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://your-app-url/login/google/callback
```


---


### 📂 Database Setup
Run the migration command to create the necessary database tables:
``` bash
php artisan migrate
```
---


###📦 Install Node Dependencies
If your project uses frontend assets (like Vue.js, React, or SCSS), install the Node.js dependencies:
```bash
npm install
```

Then, build the assets for development:
```bash
npm run dev
```

For production builds:
```bash
npm run build
```




### Add information to the database

```bash
php artisan db:seed
```


### Admin user information for testing

email: test@example.com 

password : test123


---

### 🚀 Run the Application

Start the Laravel development server:
```bash
php artisan serve
```
Open your browser and visit:
```arduino
http://localhost:8000
```
---

### 📸 Screenshots

### Questionnaires
![Dashboard Screenshot](https://raw.githubusercontent.com/temur0212/Voting_system/main/public/Screenshots/Sorovnomalar.png)

### Create a survey
![Create page Screenshot](https://raw.githubusercontent.com/temur0212/Voting_system/main/public/Screenshots/Sorovnoma_yaratish.png)

### Personal Surveys
![Create page Screenshot](https://raw.githubusercontent.com/temur0212/Voting_system/main/public/Screenshots/Mening_Sorovnomalarim.png)


---

### ❤️ Contributions
Feel free to contribute to this project. Fork, star, or submit a pull request to help us improve! 😊








