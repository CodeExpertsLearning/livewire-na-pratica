@if(session()->has('message'))

   <div class="px-5 py-4 border-green-900 bg-green-400 text-white mb-10 rounded">
       <h3>{{session('message')}}</h3>
   </div>
@endif

@if(session()->has('success'))

    <div class="px-5 py-4 border-green-900 bg-green-400 text-white mb-10 rounded">
        <h3>{{session('success')}}</h3>
    </div>
@endif

@if(session()->has('error'))

    <div class="px-5 py-4 border-red-900 bg-red-600 text-white mb-10 rounded">
        <h3>{{session('error')}}</h3>
    </div>
@endif
