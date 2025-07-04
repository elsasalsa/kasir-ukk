# 💵 Sales System for Cashiers (Kasir-UKK)

A web-based sales system built using **PHP Laravel** and **Flowbite UI**. This system supports two main roles: **Admin** and **Cashier**, each with specific features designed to streamline and manage sales activities in a retail environment.

---

## 🚀 Features

### 🛠️ Admin Role
- 📊 View sales percentages by product
- 👥 Manage users (Admin & Cashier accounts)
- 📦 Fully manage product data: add, edit, update stock, and delete products
- 📁 Export sales data to Excel
- 🧾 Download transaction receipts in PDF format

### 💼 Cashier Role
- 🧮 View today’s total sales
- 👀 View product data (read-only access)
- ➕ Add sales/transactions (with checkout system)
- 🧑‍🤝‍🧑 Manage members and implement point system
- 📁 Export daily sales to Excel
- 🧾 Print/download PDF receipt as proof of transaction

---

## 🧰 Tech Stack

- PHP Laravel
- MySQL
- Flowbite UI (Tailwind-based UI kit)
- Mpdf (for PDF export)
- Laravel Excel (for Excel export)

---

## 📦 Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/elsasalsa/kasir-ukk.git
   cd kasir-ukk
2. **Install Dependencies**
    ```bash
    composer install
3. **Create .env File**
    ```bash
    cp .env.example .env
4. **Configure Environment**

    Set up your database credentials in .env
5. **Generate Key & Migrate Database**
    ```bash
    php artisan key:generate
    php artisan migrate --seed
6. **Run the Server**
    ```bash
    php artisan serve

📜 License
This project is open-source and available under the MIT License.

## 🙋‍♀️ About Me

Built with ❤️ by **Elsa Salsa Bila**

🎓 SMK Wikrama Bogor - Software & Game Development

🔗 [LinkedIn](https://www.linkedin.com/in/elsa-salsa)

🌐 [Portfolio Website](https://elsaportfolios.netlify.app/)
