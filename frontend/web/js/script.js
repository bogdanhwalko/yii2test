$('#book_list').on('change', '#count_books_select', function () {
    $.pjax.reload({container:'#book_list', url: '/book/index' , data: {'per-page':$(this).val()}})
})