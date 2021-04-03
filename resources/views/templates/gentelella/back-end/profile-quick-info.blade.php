<!-- menu profile quick info -->
<div class="profile clearfix">

    <div class="profile_pic">
        <img src="https://styles.redditmedia.com/t5_23x4zz/styles/profileIcon_ghpt1iw1jaj31.png?width=256&height=256&crop=256:256,smart&s=cca7e01df48ea000ebae5aa551e22721435e9113" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2>
            @if(isset(Auth::user()->id))
                {{Auth::user()->first_name}}  {{Auth::user()->last_name}}
            @endif

        </h2>
    </div>
</div>
<!-- /menu profile quick info -->

<br />