<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/css/style.css">
    <script defer type="module" src="./assets/js/script.js"></script>

    <title>Winning Momento</title>
</head>

<body>
    <main class="main">
        <section class="section-form">
            <div class="container">
                <h1>Time Winning Moment</h1>
                <div class="form__container">
                    <form method="POST" class="form">
                        <div class="form__list">
                            <div class="form__group">
                                <label for="firstName" class="form__label">First Name</label>
                                <input name="firstName" id="firstName" class="form__input" type="text" placeholder="First Name">
                            </div>
                            <div class="form__group">
                                <label for="lastName" class="form__label">Last Name</label>
                                <input name="lastName" id="lastName" class="form__input" type="text" placeholder="Last Name">
                            </div>
                            <div class="form__group">
                                <label for="email" class="form__label">Email</label>
                                <input class="form__input invalid" name="email" id="email" class="email" type="email" placeholder="Email">
                            </div>
                            <div class="form__control">
                                <button id="submit" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <div class="container">
            <section class="section-winner">
                <ul class="winner__list">
                    <!-- <li class="winner__item"></li> -->
                </ul>
            </section>
        </div>
    </main>
</body>

</html>