jQuery(document).ready(function () {
    // Get the ul that holds the collection of steps
    var $etapesCollectionHolder = $('ul.etapes');
    var $ingredientssCollectionHolder = $('ul.ingredients');

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $etapesCollectionHolder.data('index', $etapesCollectionHolder.find('input').length);
    $ingredientssCollectionHolder.data('index', $ingredientssCollectionHolder.find('input').length);

    $('body').on('click', '.add_item_link', function (e) {
        var $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass');
        console.log($collectionHolderClass);
        addFormToCollection($collectionHolderClass);
    })

    $('body').on('click', '.delete_etape', function (e) {
        $id = $(this).attr('data-id') - 1;
        console.log($id);
        $('.etape').eq($id).remove();
        $('.delete_etape').eq($id).remove();
    })

});

function addFormToCollection($collectionHolderClass) {
    // Get the ul that holds the collection of tags
    var $collectionHolder = $('.' + $collectionHolderClass);

    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;

    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);

    // Add the new form at the end of the list
    $collectionHolder.append($newFormLi);

    // add a delete link to the new form
    addTagFormDeleteLink($newFormLi);

}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<button type="button">Supprimer</button>');
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on('click', function (e) {
        // remove the li for the tag form
        $tagFormLi.remove();
    });
}