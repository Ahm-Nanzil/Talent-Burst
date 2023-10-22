function loadJobListings(page) {
    $.ajax({
        url: 'job-listings.php?page=' + page,
        method: 'GET',
        dataType: 'html',
        success: function(data) {
            $('#job-listings').html(data);
        },
        error: function() {
            console.log('Error loading job listings.');
        }
    });
}

// Initial load of job listings on page load
$(document).ready(function() {
    loadJobListings(1);
});

// Pagination click event
$(document).on('click', '.pagination-wrap a.page-link', function(e) {
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    loadJobListings(page);
});