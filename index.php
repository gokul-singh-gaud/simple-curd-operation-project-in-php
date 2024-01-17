<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
        integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        label,
        select {
            text-transform: capitalize;
        }
        .hidden{
            display:none;
        }
        .myModal{
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(6, 6, 6, 0.349);
            display: none;
            justify-content: center;
            align-items: center;
        }
        .active-model{
            display: flex;
        }
        footer{
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }
    </style>
</head>

<body>
    <div class="h1 text-center bg-success bg-gradient text-white text-uppercase p-3">
        <div class="container">
            simple php CURD operation Project
        </div>
    </div>
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#" id="add">Add Person</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="view">View All Records</a>
            </li>
          </ul>
        <div class="card">
            <div class="card-body" id="addForm">
                <div class="card-title text-capitalize">
                    add person
                </div>
                <hr>
                <div class="container">
                    <form action="form-handler.php" method="post" name="addPersonForm">
                        <div class="mb-3 row">
                            <label for="person_name" class="col-sm-2 col-form-label">name</label>
                            <div class="col col-sm-10">
                                <input type="text" name="person_name" class="form-control" id="person_name" placeholder="Person Name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="age" class="col-sm-2 col-form-label">age</label>
                            <div class="col col-sm-10">
                                <input type="number" name="age" id="age" class="form-control" placeholder="22">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="male" class="col-sm-2 col-form-label">gender</label>
                            <div class="col col-sm-10 d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="male" id="male"
                                        checked>
                                    <label class="form-check-label" for="male">
                                        male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="female"
                                        id="female">
                                    <label class="form-check-label" for="female">
                                        female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="address" class="col-sm-2 col-form-label">address</label>
                            <div class="col col-sm-10">
                                <textarea name="address" class="form-control" placeholder="Your Address"
                                    id="address"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="department" class="col-sm-2 col-form-label">department</label>
                            <div class="col col-sm-10">
                                <select class="form-select" name="department" id="department">
                                    <option value="" selected><-- please select your department --></option>
                                    <option value="admin">admin</option>
                                    <option value="human resource">human resource</option>
                                    <option value="information technology">information technology</option>
                                    <option value="java development">java development</option>
                                    <option value="web development">web development</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 d-flex gap-3 justify-content-end">
                            <button type="reset" class="btn btn-secondary">
                                <i class="bi bi-arrow-repeat"></i>
                                reset
                            </button>
                            <button type="submit" id="add_person" class="btn btn-primary">
                                <i class="bi bi-plus-lg"></i>
                                add person
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body hidden" id="viewTable">
                <div class="card-title">
                    List Of All Persons
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Sr No</th>
                            <th scope="col">Person Name</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Address</th>
                            <th scope="col">Department</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="persons">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="myModal" id="myModel">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-capitalize">
                        update person information
                    </div>
                    <hr>
                    <div class="container">
                        <form action="form-handler.php" name="update" method="post">
                            <input type="hidden" name="person_id" id="person_id" value="">
                            <div class="mb-3 row">
                                <label for="person_name_u" class="col-sm-2 col-form-label">name</label>
                                <div class="col col-sm-10">
                                    <input type="text" name="person_name_u" class="form-control" id="person_name_u" placeholder="Person Name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="age_u" class="col-sm-2 col-form-label">age</label>
                                <div class="col col-sm-10">
                                    <input type="number" name="age_u" id="age_u" class="form-control" placeholder="22">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="male_u" class="col-sm-2 col-form-label">gender</label>
                                <div class="col col-sm-10 d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender_u" value="male" id="male_u">
                                        <label class="form-check-label" for="male_u">
                                            male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender_u" value="female"
                                            id="female_u">
                                        <label class="form-check-label" for="female_u">
                                            female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="address_u" class="col-sm-2 col-form-label">address</label>
                                <div class="col col-sm-10">
                                    <textarea name="address_u" class="form-control" placeholder="Your Address"
                                        id="address_u"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="department_u" class="col-sm-2 col-form-label">department</label>
                                <div class="col col-sm-10">
                                    <select class="form-select" name="department_u" id="department_u">
                                        <option value="" selected><-- please select your department --></option>
                                        <option value="admin">admin</option>
                                        <option value="human resource">human resource</option>
                                        <option value="information technology">information technology</option>
                                        <option value="java development">java development</option>
                                        <option value="web development">web development</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 d-flex gap-3 justify-content-end">
                                <button type="reset" name="cancel" id="cancel" class="btn btn-danger">
                                    <i class="bi bi-arrow-left"></i>
                                    Cancel
                                </button>
                                <button type="submit" name="update" class="btn btn-primary" id="updateInformation">
                                    <i class="bi bi-upload"></i>
                                    Update Information
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="text-center bg-secondary bg-gradient text-white">
            <div class="contaoner">
                Design & Developed by <a href="https://github.com/gokul-singh-gaud" target="_blank" class="text-white">Gokul Singh Gaud</a>
            </div>
        </div>
    </footer>
</body>
<script src="./script.js"></script>

</html>