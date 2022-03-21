<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use File;

class Profile extends Component
{

    use WithFileUploads;

   public $userId;
   public $name;
   public $email;
   public $password;
   public $contact;
   public $bio;
   public $image;

   public $prevName;
   public $prevEmail;
   public $prevContact;
   public $prevBio;
   public $url;
 

   protected $rules = [
       'name' => 'required|max:100',
       
     

   ];


   public function mount() {
      
       $this->userId = auth()->user()->id;

       $model = User::find($this->userId);
       $this->name = $model->name;
       $this->contact = $model->contact;
       $this->bio = $model->bio;
       $this->image = $model->image;
    
  
       $this->prevName = $model->name;
       $this->prevContact = $model->contact;
       $this->prevBio = $model->bio;
       $this->prevImg = $model->image;
 
    
 
   }


 



   public function save() {

         $this->validate();

         
           $data = [];


          //We will check if there are any changes in the fields

     
          if($this->image != $this->prevImg) {
              Storage::disk('public')->delete($this->prevImg);
              $this->url = $this->image->store('photos','public');
              $data = array_merge($data, ['image' => $this->url ]);
          }

          if($this->name !== $this->prevName) {
              $data = array_merge($data, ['name' => $this->name]);
          }

          if($this->contact !== $this->prevContact) {
            $data = array_merge($data, ['contact' => $this->contact]);
        }

        if($this->bio !== $this->prevBio) {
            $data = array_merge($data, ['bio' => $this->bio]);
        }
         
     

      


          if(count($data)) {
            User::find($this->userId)->update($data);
            session()->flash('success', 'User profile has been successfully updated');
 
            return redirect(request()->header('Referer'));
          }


   }





    public function render()
    {
        return view('livewire.profile');
    }
}
