//Global object to store the files
let fileStorage = {};

$(document).ready(function(){
    $("input[type='file']").change(function(e){
        //Get the id
        let id = e.target.id;

        //Get the files
        let files = e.target.files;

        //Store the file
        storeFile(id, files);

        //Show the complete icon
        $(this).siblings('.icon').hide();
        $(this).parent().removeClass('drawn');
        setTimeout(() => {
            $(this).parent().addClass('drawn');
        }, 50);
    });


    //Store the file for particular filepicker
    let storeFile = (id, files) => {
        fileStorage[id] = files;

        //Update the file count
        $(`[data-id="${id}"] > .file-total-viewer`).text(files.length);
    }

    //Show file list
    $('[data-toggle="popover"]').popover({
        html: true,
        title: "Files",
        content: function () {
            //Get the id of the file picker
            let id = $(this).attr('data-id');

            //Get all the files of this filepicker
            let items = fileStorage[id];

            //Preview the file
            let template = '<div class="row">';
            if(items && items.length){
                for(let val of items){
                    template += "<div class='col-12 pb10'><span class='popover-content-file-name'>" + val.name + "</span><span class='popover-content-remove' data-target='" + id + "' data-name='" + val.name + "' data-type='upload'><i class='fas fa-trash'></i></span></div>"
                }
            }else{
                template += "<div class='col-12 pb10'><span class='popover-content'>No file found</span></div>";
            }

            template += '</div>';
            return template;
        },
        placement:"bottom"
    });

    //Prevent multiple popover
    $('body').on('click', function (e) {
        $('[data-toggle="popover"],[data-original-title]').each(function () {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                (($(this).popover('hide').data('bs.popover') || {}).inState || {}).click = false;  // fix for BS 3.3.6
            }
        });
    });

    //Delete files
    $(document).on('click', '.popover-content-remove', function (e) {
        //Get the id whose file to delete
        let id = $(this).attr('data-target');

        //Get the name of the file to delete
        let name = $(this).attr('data-name');

        //Confirm delete
        let isDelete = confirm("Do you really want to delete this file?");

        //If confirmed
        if (isDelete) {
            //Remove the requested file
            let files = Object.values(fileStorage[id]);
            let newArr = files.filter((e) => { return e.name !== name; });

            //Update the list
            storeFile(id, newArr);

            //If there is no file then show No file
            if(newArr.length === 0){
                $(this).parent().parent().append("<div class='col-12 pb10'><span class='popover-content'>No file</span></div>");
            }

            //Remove the current file
            $(this).parent().remove();

        }
    });
});