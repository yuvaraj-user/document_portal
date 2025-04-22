<!DOCTYPE html>
<html>
	<head></head>

	<body>

		

		
		<!-- Load the pdf.js library as a module -->
		<script type="module">
			import * as pdfjsLib from 'https://mozilla.github.io/pdf.js/build/pdf.mjs';

			pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.mjs';

			function extractText(pdfUrl) {
				var pdf = pdfjsLib.getDocument(pdfUrl);
				return pdf.promise.then(function (pdf) {
					var totalPageCount = pdf.numPages;
					var countPromises = [];
					for (var currentPage = 1;currentPage <= totalPageCount;currentPage++) {
						var page = pdf.getPage(currentPage);
						countPromises.push(
							page.then(function (page) {
								var textContent = page.getTextContent();
								return textContent.then(function (text) {
									return text.items
										.map(function (s) {
											return s.str;
										})
										.join('');
								});
							}),
						);
					}

					return Promise.all(countPromises).then(function (texts) {
						return texts.join('');
					});
				});
			}

			const url = 'Noc Confirmation.pdf';

			extractText(url).then(
				function (text) {
					console.log('parse ' + text);


				},
				function (reason) {
					console.error(reason);
				},
			);
		</script>
	</body>
</html>