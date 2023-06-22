<head>
    <style>
        input{
            height:40px;
            width:70%;
        }
        label{
            font-size:15px;
        }
        textarea{
            width:70%;
        }
        button{
            background:blue;
            border:none;
            color:white;
            font-size:14px;
            padding:10px;
            width:25%;
        }
    </style>
</head>
<h1>Mail Here</h1>
<form method="post" action="">
        <label for="sge_email">To</label><br>
        <input type="email" name="sge_email" placeholder="Enter Recipient's email" required>
        <br><br>
    
        <label for="sge_subject">Subject</label><br>
        <input type="text" name="sge_subject" placeholder="Enter your Subject Here" required>
        <br><br>

        <textarea name="sge_message" cols="20" rows="8" placeholder="Enter your Message Here" required></textarea>
        <br><br>

        <button type="submit" name="SGM_submit" class="btn btn-primary">Submit</button>
        <?php 
             wp_nonce_field('sge_email_form');
         ?>
</form>

