<div class="box">
   <div class="padding-md">
       <div class="list-group text-center">
           <a href="{{route('users.edit', $user->id)}}" class="list-group-item {{navActiveView('users.edit')}}" data-pjax>
               <i class="text-md fa fa-list-alt" aria-hidden="true"></i>&nbsp;个人信息
           </a>
           <a href="{{route('users.edit_avatar', $user->id)}}" class="list-group-item {{navActiveView('users.edit_avatar')}}" data-pjax>
               <i class="text-md fa fa-picture-o" aria-hidden="true"></i>&nbsp;修改头像
           </a>
           <a href="{{route('users.edit_password', $user->id)}}" class="list-group-item {{navActiveView('users.edit_password')}}" data-pjax>
               <i class="text-md fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;修改密码
           </a>
       </div>
   </div>
</div>