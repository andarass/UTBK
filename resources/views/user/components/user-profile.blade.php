<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <style>


        img {
            max-width: 100%;
            height: auto;
        }

        ul {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            gap: 3rem;
        }

        li {
            list-style-type: none;
            position: relative;
            padding: 0.625rem 0 0.5rem;
        }

        li ul {
            flex-direction: column;
            position: absolute;
            background-color: white;
            align-items: flex-start;
            transition: all 0.5s ease;
            width: 20rem;
            right: -3rem;
            top: 4.5rem;
            border-radius: 0.325rem;
            gap: 0;
            padding: 1rem 0rem;
            opacity: 0;
            box-shadow: 0px 0px 100px rgba(20, 18, 18, 0.25);
            display: none;
        }

        ul li:hover>ul,
        ul li ul:hover {
            visibility: visible;
            opacity: 1;
            display: flex;
        }

        .material-icons-outlined {
            color: #888888;
            transition: all 0.3s ease-out;
        }

        .material-icons-outlined:hover {
            color: #ff9800;
            transform: scale(1.25) translateY(-4px);
            cursor: pointer;
        }


        .profile {
            height: 3rem;
            width: auto;
            cursor: pointer;
        }

        .sub-item {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 0.725rem;
            cursor: pointer;
            padding: 0.5rem 1.5rem;
        }

        .sub-item:hover {
            background-color: rgba(232, 232, 232, 0.4);
        }

        .sub-item:hover .material-icons-outlined {
            color: blue;
            transform: scale(1.08) translateY(-2px);
            cursor: pointer;
        }

        .sub-item:hover p {
            color: #000;
            cursor: pointer;
        }

        .sub-item p {
            font-size: 0.85rem;
            color: #888888;
            font-weight: 500;
            margin: 0.4rem 0;
            flex: 1;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li>
                <img src="{{ asset('assets/images/user/andara.jpeg') }}" class="profile" />
                <ul>
                    <li class="sub-item">
                        <span class="material-icons-outlined"> grid_view </span>
                        <p>Dashboard</p>
                    </li>
                    <li class="sub-item">
                        <span class="material-icons-outlined">
                            format_list_bulleted
                        </span>
                        <p>My Orders</p>
                    </li>
                    <li class="sub-item">
                        <span class="material-icons-outlined"> manage_accounts </span>
                        <p>Update Profile</p>
                    </li>
                    <li class="sub-item">
                        <span class="material-icons-outlined"> logout </span>
                        <p>Logout</p>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</body>
</html>
