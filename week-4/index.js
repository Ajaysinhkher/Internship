$(document).ready(function () {
  // to get values from local storage
  let groups = JSON.parse(localStorage.getItem("groups") || "[]");
  let expense = JSON.parse(localStorage.getItem("expense") || "[]");

  //function to format date
  function formatDate(date) {
    const options = {
      year: "numeric",
      month: "short",
      day: "numeric",
      hour: "2-digit",
      minute: "2-digit",
      hour12: true,
    }; 
    return new Date(date).toLocaleString("en-US", options);
  }

  //to render new group to ui:
  function renderGroups() {
    let tbody = $("#groupList tbody");
    tbody.empty();

    //to add the added groups in select options for expenses :
    let grp_select = $("#groupSelect");
    grp_select.empty(); //reset
    grp_select.append('<option value="">Select Group</option>'); //set default option

    groups.forEach((group, index) => {
      tbody.append(`
              <tr>
              <td>${group.name}</td>
              <td>${formatDate(group.createdAt)}</td>
              <td>${formatDate(group.updatedAt)}</td>
              <td>
                   
                   <button class="delete-group" data-index="${index}">Delete</button>
              </td>
              </tr>`);

      // add group to select dropdown:
      grp_select.append(`<option value="${group.name}">${group.name}</option>`);
    });
  }

  //function to render expense:

  function renderExpense() {
    let etbody = $("#expenseList tbody");
    etbody.empty();

    expense.forEach((expobj, index) => {
      etbody.append(`
                  <tr>
                  <td>${expobj.group}</td>
                  <td>${expobj.name}</td>
                  <td>${expobj.amount}</td>
                  <td>${formatDate(expobj.date)}</td>
                  <td> <button class="delete-expense" expense-index="${index}">Delete</button></td>
                  </tr>`);
    });

    groupWiseExpense();
  }

  // function to get total expense:
  function totalexpense() {
    let total_amount = 0;

    expense.forEach((element) => {
      total_amount += parseInt(element.amount);
    });
    // console.log(total_amount);
    $("#totalExpense p span").text(total_amount);
  }

  //   function to get monthly highest expense and current month expense:

function highestExpense(){
  let amount_array= [];
  let max_amount = 0; 
  let Monthly_expense = 0;
  let currentMonth = new Date().getMonth();
  let currentYear  = new Date().getFullYear();

  expense.forEach((element)=>{
    let expenseDate = new Date(element.date)

    if(expenseDate.getMonth() === currentMonth && expenseDate.getFullYear() === currentYear)
    {
      amount_array.push(parseInt(element.amount));
    }
  }) 

  for(let i=0;i<amount_array.length;i++)
  {
    if(amount_array[i]>max_amount)
    {
      max_amount = amount_array[i];
    }
    Monthly_expense += amount_array[i];
  }

  $('#highestExpense p span').text(max_amount);
  $('#monthlyExpense p span').text(Monthly_expense);
  // console.log(max_amount);
  
}


// function to get group wise total expense:

function groupWiseExpense(){
  
  let groupExpense = {};
  $('#groupStats').empty(); 
  expense.forEach(expense => {
    if(!groupExpense[expense.group]){
      groupExpense[expense.group] = [];
    }
    // push expense inside the group present in groupexpense:
    groupExpense[expense.group].push(expense);
  })

  for(let group in groupExpense)
  {
    let grouplist  = groupExpense[group];
    let groupTotal = grouplist.reduce((total, exp) => total + parseFloat(exp.amount), 0);
    $('#groupStats').append(`
      <ul>
      <b>${group}:</b>
      <span> Total exense: ${groupTotal}</span>
      </ul>`)
  }
}
  

  // function to add new group:
  $("#addGroup").on("click", function () {
    let grp_name = $("#groupName").val().trim();
    // console.log(grp_name);
    if (grp_name === "") return alert("enter a valid group name");

    // Check if the group name already exists
    let isDuplicate = groups.some(
      (group) => group.name.toLowerCase() === grp_name.toLowerCase()
    );
    if (isDuplicate) {
      return alert(
        "This group already exists. Please choose a different name."
      );
    }

    // creating a new group object with the required data:
    let newgroup = {
      name: grp_name,
      createdAt: new Date().toISOString(),
      updatedAt: new Date().toISOString(),
    };

    // push the newgroup object to groups array object:
    groups.push(newgroup);
    localStorage.setItem("groups", JSON.stringify(groups));

    // render group to ui using function:
    renderGroups();
    $("#groupName").val(""); //clear input
  });

  
  renderGroups(); //for rendering already stored groups


  // function  to add expense:

  $("#addExpense").on("click", function () {
    let exp_name = $("#expenseName").val().trim();
    selectedDate = $('#expenseDate').val();
 
   if (exp_name === "") return alert("enter a valid expense name");

    let exp_grp = $("#groupSelect").val().trim();
    // console.log(exp_grp);
    let exp_amount = $("#expenseAmount").val();
    let exp_date = $("#expenseDate").val();

    // condition check
    if (exp_grp == "" || exp_amount == "" || exp_date == "") {
      alert("please fill the empty fields");
      return;
    }

  // creating a expense data object:

      let exp = {
      group: exp_grp,
      name: exp_name,
      amount: exp_amount,
      date: new Date(selectedDate).toISOString(),
    };

    expense.push(exp);
    localStorage.setItem("expense", JSON.stringify(expense));

    // render expenses to ui:
    renderExpense();
    $("#expenseName").val("");
    $("#expenseAmount").val("");
    $("#expenseDate").val("");
    totalexpense();
    highestExpense();
   
    
  });

  renderExpense();
  totalexpense();
  highestExpense();


  //function to delete group and associated expenses:
  $(document).on("click", ".delete-group", function () {
    let index = $(this).data("index");

    if (index !== undefined) {
      let groupToDelete = groups[index];
      alert(
        `it will remove all the expenses associated with the ${groupToDelete.name}`
      );

      // Remove the group from the array
      groups.splice(index, 1);

      // Update the global expense array instead of creating a new variable
      expense = expense.filter((exp) => exp.group !== groupToDelete.name);

      // Update local storage
      localStorage.setItem("groups", JSON.stringify(groups));
      localStorage.setItem("expense", JSON.stringify(expense)); // Use the updated global expense

      // Re-render UI
      renderExpense();
      renderGroups();
      totalexpense();
      highestExpense();  
    }
  });

  // function to delete the expense:

  $(document).on("click", ".delete-expense", function () {
    let index = $(this).attr("expense-index"); // Use attr() instead of data()
    index = parseInt(index); // Convert to number

    if (!isNaN(index) && index >= 0) {
      
    // Remove the expense from the array
      expense.splice(index, 1);

      // Update localStorage
      localStorage.setItem("expense", JSON.stringify(expense)); 

      // Re-render the expense list
      renderExpense();
      totalexpense();
      highestExpense();
    }
  });
});
