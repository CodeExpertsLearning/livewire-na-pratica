@if(session()->has('message'))

   <div class="px-5 py-4 border-green-900 bg-green-400 text-white mb-10">
       <h3>{{session('message')}}</h3>
   </div>
@endif
