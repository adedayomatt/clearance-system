
var imageUpload = document.querySelectorAll('.preview-image');

imageUpload.forEach(previewImages);
   
function previewImages(form) {
    var input = form.querySelector("input[type='file']");
    var preview = form.querySelector(".image-preview-container");
    var status = document.createElement('p');
    var images = document.createElement('div');
    images.style.display = 'flex';

    status.setAttribute('class','text-center text-info');
    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp|.mp4)$/;
     
    preview.appendChild(status);
    preview.appendChild(images);

    status.innerHTML = 'Select Images to upload';
    
    input.addEventListener('change', function(e){
      images.innerHTML = ''; //clear previous preview (if any..);
      
       for(var i = 0; i<input.files.length; ++i){
            var file = input.files[i];
            if (regex.test(file.name.toLowerCase())){//If a valid image
                var reader = new FileReader();
                reader.onload = function(e){
                    if(preview.hasAttribute('replace')  && form.querySelector(preview.getAttribute('replace')) !== null){
                        var prev = form.querySelector(preview.getAttribute('replace'));
                        prev.src =  e.target.result;
                    }
                    else{
                        var imageContainer = document.createElement('div');
                        imageContainer.style.width = preview.getAttribute('preview-width') || '200px';
                        imageContainer.style.height = preview.getAttribute('preview-height') || 'auto';

                        var image = new Image();
                        image.src = e.target.result;
                        image.style.width = '100%';
                        image.style.height = preview.getAttribute('preview-height') || 'auto';
                        imageContainer.appendChild(image);
                        /*if(preview.hasAttribute('caption')){
                          var caption = document.createElement('textarea');
                          caption.setAttribute('class','form-control');
                          caption.setAttribute('name',preview.getAtrribute('caption')+);
                          caption.setAttribute('placeholder','image caption');
                          caption.style.height = '80px !important';
                          imageContainer.appendChild(caption);
                        }*/
                        images.appendChild(imageContainer);
                      }
                    }
                reader.readAsDataURL(file);
            }else{
              //input.files.splice(i,1);//remove from the file array
              alert(file.name+' is not a valid image');
            }
       }

    });
  }
      