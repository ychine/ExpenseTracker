<div class="add-form">
<form id="add-form" method="POST" action="script/addtorecord.php">
    <div class="addsmoothbox">
        <div class="sbcontent">
            <h3>Add Income or Expenses</h3>
            <div class="toggleie" required>
                <input type="radio" name="type" id="income" value="Income"/>
                <label class="incometoggle" for="income">Income</label>
                <input type="radio" name="type" id="expense" value="Expense"  checked="checked" />
                <label class="expensetoggle" for="expense">Expenses</label>
            </div>
            <div class="Amount">
                <label for="Amount">Amount</label>
                PHP<input type="number" name="amount" class="amounttext" required>
            </div>
            <div class="Description">
                <label for="Description">Description</label>
                <select id="description" name="description" class="desc" default="---" required>
                    
                </select> 
            </div>
            <div class="Date">
                <label for="Date">Date</label>
                <input type="datetime-local" name="datetime" class="dtpicker" required>
            </div>
            <div class="menusfooter">
                <button type="button" class="cancel" onclick="resetForm()">Cancel</button>
                <div class="addframebg">
                    <button type="submit" class="add">Add</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>