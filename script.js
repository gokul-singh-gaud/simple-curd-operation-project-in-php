 $(document).ready(()=>{

    loadData();
    // nav buttons
    const  tab1 = document.querySelector("#add");
    const  tab2 = document.querySelector("#view");
    // all form buttons
     const addPerson = document.querySelector("#add_person"); 
     const updateInformation = document.querySelector("#updateInformation"); 
     const cancel = document.querySelector("#cancel"); 
    //  all components
    const myModel = document.querySelector("#myModel");
    const addForm = document.querySelector("#addForm");
    const viewTable = document.querySelector("#viewTable");
    // table buttons
     // add event listener to buttons 
     $(tab1).on("click", (e)=>{
        e.preventDefault();
        if($(tab1).hasClass("active") == false){
            tab1.classList.add("active");
            tab2.classList.remove("active");
            addForm.classList.remove("hidden")
            viewTable.classList.add("hidden")
        }
     })
     $(tab2).on("click", (e)=>{
        e.preventDefault();
        if($(tab2).hasClass("active") == false){
            tab2.classList.add("active");
            tab1.classList.remove("active");
            addForm.classList.add("hidden")
            viewTable.classList.remove("hidden")
        }
     })

    
     
    $(cancel).on("click",()=>{
        myModel.classList.remove("active-model")
    })
    $(myModel).on("click", (event)=>{
        let el = (event.target);
        if($(el).parents(".container")[0] == undefined){
            myModel.classList.remove("active-model")

        }
    })


    document.querySelector("#persons").querySelectorAll("tr").forEach((tr, index)=>{
        tr.querySelector("th").innerText = index + 1
    })


    $("form[name='addPersonForm']").on("submit",(event)=>{
        event.preventDefault();
        var data = {

            name : document.forms['addPersonForm']['person_name'].value,
            age : document.forms['addPersonForm']['age'].value,
            gender : document.forms['addPersonForm']['gender'].value,
            address : document.forms['addPersonForm']['address'].value,
            department : document.forms['addPersonForm']['department'].value,
        }
            
        $.ajax({
            url: "form-handler.php",
            type: "POST",
            data: { data, addPerson : true },
            success: function(data, status) {
                let res = JSON.parse(data)
                swal(status, res, "success");
                loadData();
                document.forms['addPersonForm'].reset();

            },
            error: function(jqXHR, status, error) {
                swal(status, error, "danger");
            }
          });

    })

    $("form[name='update']").on("submit",(event)=>{
        event.preventDefault();
        var data = {

            id : document.forms['update']['person_id'].value,
            name : document.forms['update']['person_name_u'].value,
            age : document.forms['update']['age_u'].value,
            gender : document.forms['update']['gender_u'].value,
            address : document.forms['update']['address_u'].value,
            department : document.forms['update']['department_u'].value,
        }
        // console.log(data)
        $.ajax({
            url: "form-handler.php",
            type: "POST",
            data: { data, update : true },
            success: function(data, status) {
                // console.log(data)
                let res = JSON.parse(data)
                swal(status, res, "success");
                myModel.classList.remove("active-model")
                loadData()
            },
            error: function(jqXHR, status, error) {
                swal(status, error, "danger");
            }
          });

    })

    document.querySelectorAll(".delete-information").forEach(function(btn) {
        
    })




})
function loadData(){
    $.ajax({
        url: "form-handler.php",
        type: "POST",
        data: { 
            showAllRecord: true
         },
        success: function(data, status) {
            let res = JSON.parse(data)
            let el = document.getElementById("persons");
            el.innerHTML = "";
            if(res[0] != undefined){
            res.forEach((data, index)=>{
                let tr = document.createElement("tr");
                let innerHTML =    `
                                <th scope="row">`+(index+1)+`</th>
                                <td>`+data['name']+`</td>
                                <td>`+data['age']+`</td>
                                <td>`+data['gender']+`</td>
                                <td>`+data['address']+`</td>
                                <td>`+data['department']+`</td>
                                <td class="text-center">
                                    <button class="btn btn-primary edit-information" id="`+data['id']+`" onclick="edit(`+data['id']+`)" area-label="edit button">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-danger delete-information" value="`+data['id']+`"  onclick="del(`+data['id']+`)" area-label="delete button">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>                                
                                </td>
                            `;
                tr.innerHTML = innerHTML;
                el.appendChild(tr);
            })

            }
            else{
                let tr = document.createElement("tr");
                let innerHTML =    `
                                <td colspan="7" >`+res['res']+`</td>
                            `;
                tr.innerHTML = innerHTML;
                el.appendChild(tr);
            }
        },
        error: function(jqXHR, status, error) {
            alert("error loading data" + error)
        }
      });
}
function deleteData(id){
    $.ajax({
        url: "form-handler.php",
        type: "POST",
        data: { 
            id : id,
            delete : true,
         },
        success: function(data, status) {
            // console.log(data)
            let res = JSON.parse(data)
            swal(status, res, "success");
        },
        error: function(jqXHR, status, error) {
            swal(status, error, "danger");
        }
      });
      
      loadData()
} 

    function edit(rid){
            let row = $("button[id='"+rid+"").parents("tr")[0]
            console.log(row.querySelectorAll("td")[0].innerHTML)
            let person_id = rid;
            myModel.classList.add("active-model")
            let form = myModel.querySelector("form[name='update']")
            let id = form.querySelector('input[name="person_id"]');
            let name = form.querySelector('input[name="person_name_u"]');
            let age = form.querySelector('input[name="age_u"]');
            let gender = form.querySelector('input[id="'+row.querySelectorAll("td")[2].innerHTML+'_u"]');
            let address = form.querySelector('textarea[name="address_u"]');
            let department = form.querySelector('select[name="department_u"]');
            id.value = person_id
            name.value= row.querySelectorAll("td")[0].innerHTML
            age.value= row.querySelectorAll("td")[1].innerHTML

            $(gender).prop("checked", true)
            address.value= row.querySelectorAll("td")[3].innerHTML

            let options = department.querySelectorAll("option")
            options.forEach((option)=>{
                $(option).prop("selected", false)
                if(option.text == row.querySelectorAll("td")[4].innerHTML){
                    $(option).prop("selected", true)
                }
            })

            loadData();
    }
    function del(id){
            let person_id = id;
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this information!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                    deleteData(person_id);
                    loadData();
                } else {
                  swal("Your information is safe!");
                }
              });
    }
