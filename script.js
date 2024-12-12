    // Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);

    // Function to set the selected option based on URL parameter
    function setSelectedOption(selectorId, paramName) {
        const element = document.getElementById(selectorId);
        const paramValue = urlParams.get(paramName);
        if (paramValue) {
            element.value = paramValue;
        }
    }

    // Set the selected values for each dropdown
    setSelectedOption('chainselector', 'chain');
    setSelectedOption('categoryselector', 'category');
    setSelectedOption('marketCapSelect', 'marketcap');
    setSelectedOption('auditselector', 'audit');
    setSelectedOption('kycselector', 'kyc');

    // Apply filters and redirect with updated URL parameters
    document.getElementById('applyfilter').addEventListener('click', function (event) {
        event.preventDefault();  // Prevent form submission
        const form = document.getElementById('filterForm');
        const url = new URL(window.location.origin + '/coinlistz.com/index.php#coinstable'); // Adjust the path if needed

        // Get all form data
        const formData = new FormData(form);

        // Loop through each form entry and add to URL if not empty
        formData.forEach((value, key) => {
            if (value !== "") {
                url.searchParams.append(key, value);
            }
        });

        // Redirect to the built URL
        window.location.href = url;
    });

    // Highlight the active chain link based on the 'chain' parameter in the URL
    const selectedChain = urlParams.get('chain'); 

    // If the 'chain' parameter exists in the URL
    if (selectedChain) {
        // Find the corresponding chain link by ID
        const chainLink = document.getElementById(`chain-${selectedChain}`);
        if (chainLink) {
            // Remove the active class from the 'All Chains' link
            document.getElementById('allChains').classList.remove('active');
            // Add the active class to the selected chain link
            chainLink.classList.add('active');
        }
    } else {
        // If no 'chain' parameter, keep the 'All Chains' link as active
        document.getElementById('allChains').classList.add('active');
    }

let isSidebarHidden = false;

function checkScreenSize() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    
    if (window.innerWidth < 768) { // Assuming 768px as the breakpoint for smaller screens
        sidebar.classList.add('slide-out', 'displaynone');
        sidebar.classList.remove('col-lg-2');
        content.classList.remove('col-lg-10');
        content.classList.add('col-lg-12');
        isSidebarHidden = true;
    } else {
        sidebar.classList.remove('slide-out', 'displaynone');
        sidebar.classList.add('col-lg-2');
        content.classList.remove('col-lg-12');
        content.classList.add('col-lg-10');
        isSidebarHidden = false;
    }
}

document.getElementById('sidebarToggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    if (isSidebarHidden) {
        sidebar.classList.remove('slide-out', 'displaynone');
        sidebar.classList.add('slide-in', 'col-lg-2');
        content.classList.remove('col-lg-12');
        content.classList.add('col-lg-10');
    } else {
        sidebar.classList.remove('slide-in', 'col-lg-2');
        sidebar.classList.add('slide-out', 'displaynone');
        content.classList.remove('col-lg-10');
        content.classList.add('col-lg-12');
    }
    isSidebarHidden = !isSidebarHidden;
});

// Initial check on page load
checkScreenSize();

// Add event listener to handle window resize
window.addEventListener('resize', checkScreenSize);


 