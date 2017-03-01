tinyMCEPopup.requireLangPack();

var iconMap = [
"fa-dollar","fa-download","fa-ellipsis-h","fa-ellipsis-v","fa-envelope","fa-envelope-o","fa-exchange","fa-exclamation-circle","fa-external-link","fa-fa","fa-facebook","fa-file","fa-file-archive-o","fa-file-audio-o","fa-file-code-o","fa-file-code-o","fa-file-excel-o","fa-file-image-o","fa-file-o","fa-file-pdf-o","fa-file-powerpoint-o","fa-file-text","fa-file-video-o","fa-file-word-o","fa-filter","fa-folder","fa-folder-open","fa-font","fa-gear","fa-github","fa-google-plus","fa-heart","fa-home","fa-info","fa-language","fa-leaf","fa-lightbulb-o","fa-line-chart","fa-link","fa-linkedin","fa-location-arrow","fa-lock","fa-map-marker","fa-minus-square","fa-paperclip","fa-pause","fa-phone","fa-pie-chart","fa-play","fa-plus","fa-print","fa-qq","fa-question-circle-o","fa-recycle","fa-refresh","fa-refresh","fa-remove","fa-repeat","fa-rocket","fa-rss","fa-search","fa-share-alt","fa-share-alt","fa-shopping-cart","fa-sign-in","fa-sign-language","fa-sort","fa-sort-alpha-asc","fa-sort-alpha-desc","fa-sort-asc","fa-sort-desc","fa-spinner","fa-star","fa-star-half","fa-step-backward","fa-step-forward","fa-sun-o","fa-support","fa-tag","fa-tags","fa-thumb-tack","fa-thumbs-o-up","fa-thumbs-up","fa-times","fa-trash","fa-twitter","fa-unlock","fa-unlock-alt","fa-unsorted","fa-user","fa-user-plus","fa-users","fa-video-camera","fa-vimeo","fa-volume-off","fa-wheelchair","fa-wrench","fa-youtube-play"
];

tinyMCEPopup.onInit.add(function() {
  tinyMCEPopup.dom.setHTML('iconMapView', renderIconMapHTML());
});

function renderIconMapHTML() {
  var iconsPerRow = 14, tdWidth = 20, tdHeight = 20, i;
  var html = ' <table border="0" cellspacing="1" cellpadding="0" width="' + (tdWidth * iconsPerRow) + '"><tr height="' + tdHeight + '">';
  var cols=0;

  for (i = 0; i < iconMap.length; i++) {

    cols++;
    html += ''
        + '<td class="charmap">'
        + '<a onmouseover="previewIcon(\'' + iconMap[i] + '\');" onfocus="previewIcon(\'' + iconMap[i] + '\');" href="javascript:void(0)" onclick="insertIcon(\'' + iconMap[i] + '\');" onclick="return false;" onmousedown="return false;" title="">'
        + '<i class="fa ' + iconMap[i] + '" aria-hidden="true"></i>'
        + '</a></td>'

    if ((cols) % iconsPerRow == 0)
      html += '</tr><tr height="' + tdHeight + '">';

  }

  if (cols % iconsPerRow > 0) {
    var padd = iconsPerRow - (cols % iconsPerRow);
    for (var i = 0; i < padd - 1; i++)
      html += '<td width="' + tdWidth + '" height="' + tdHeight + '" class="charmap">&nbsp;</td>';
  }

  html += '</tr></table>';

  return html;
}

function insertIcon(chr) {
  tinyMCEPopup.execCommand('mceInsertRawHTML', false, '<span class="fa ' + chr + ' " aria-hidden="true">&nbsp;</span>');

  // Refocus in window
  if (tinyMCEPopup.isWindow)
    window.focus();

  tinyMCEPopup.editor.focus();
  tinyMCEPopup.close();
}

function previewIcon(chr) {
  var elmV = document.getElementById('codeV');
  var elmN = document.getElementById('codeN');

  elmV.innerHTML = "<i class='fa "+chr+"'></i>";
  elmN.innerHTML = chr.substring(3);
}
