
<h1><?php echo $pageTitle ?></h1>
<div class="well">
 
    <h4>Send message</h4>
 
    <form method="POST" action="<?= base_url().'admin/send' ?>" role="form" class="clearfix">
 
        <div class="col-md-6 form-group">
            <label class="sr-only" for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="<?= $user[0]['username'] ?>" disabled>
        </div>
 
        <div class="col-md-6 form-group">
            <label class="sr-only" for="email"></label>
            <input type="email" class="form-control" id="email" placeholder="<?= $user[0]['email'] ?>" disabled>
        </div>
 
        <div class="col-md-12 form-group">
            <label class="sr-only" for="email">Message</label>
            <textarea class="form-control" id="message" placeholder="Message"></textarea>
        </div>
 
        <div class="col-md-12 form-group text-right">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
 
    </form>                   
</div>