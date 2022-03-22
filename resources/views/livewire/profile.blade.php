<section class="subscribe mb-10"   
 x-data="{
  showSuccess:@entangle('showSuccess')
}">

  
            

  



  
   
      <div>
      

@if(Session::has('success'))
                    
<div class="text-center  mt-8">


   <p class="text-red-700 bg-green-600 bg-opacity-20 text-lg p-4">{{Session::get('success')}}</p>
</div>




@endif



        <div >

          @if(Auth::user()->image)
          <img class="block h-10 w-auto fill-current" src="{{ asset('storage/' . Auth::user()->image)}}">

          @else
           
          <p>No Image</p>
         
          @endif

          <form  wire:submit.prevent="save" enctype="multipart/form-data">@csrf
          <div class="{{ $errors->has('name') ? 'has-error' : '' }}">
         
            <input wire:model.defer="name" class="w-full ring-sec focus:ring-1 bg-gray-300 text-gray-900 mt-2 p-3  focus:outline-none focus:shadow-outline"
              type="text" name="name" placeholder="Name">
              <span class="text-red-700 bg-red-600 bg-opacity-20 text-xs  rounded">{{ $errors->first('name') }}</span>
          </div>
         

          <div class="mt-8">
    
            <input wire:model.defer="contact" class="w-full ring-sec focus:ring-1 bg-gray-300 text-gray-900 mt-2 p-3  focus:outline-none focus:shadow-outline"
              type="text" name="contact" placeholder="Contact">
             
          </div>
          <div class="mt-8  {{ $errors->has('bio') ? 'has-error' : '' }}">
            <span class="uppercase font-title text-sm text-gray-600 font-bold">Bio</span>
            <textarea wire:model.defer="bio"
              class="w-full ring-sec focus:ring-1 h-32 bg-gray-300 text-gray-900 mt-2 p-3  focus:outline-none focus:shadow-outline" name="bio" ></textarea>
              
            </div>

            <div class="">
            <input type="file"  id="image" wire:model="image">
        
          
             </div>                           
</div>

          




          <div class="mt-8 text-center">
         
            <x-button
              class=" uppercase font-title text-sm font-bold tracking-wide bg-sec px-5 py-3 w-80 justify-center text-white rounded-3xl  hover:bg-blue-800 text-gray-100 p-3 rounded-lg w-full focus:outline-none focus:shadow-outline">
              <span class="animate-spin" wire:loading wire:target="save">&#9696;</span>
              <span wire:loading.remove wire:target="save">Save</span>
            </x-button>
          </div>


        </form>
        </div>
      </div>



</section>


