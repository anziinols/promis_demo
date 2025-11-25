<?= $this->extend("templates/nolstemp"); ?>
<?= $this->section('content'); ?>

<div class="container py-4">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>About PROMIS</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <p class="lead">
                            Welcome to Project Management Information System (PROMIS), the vital tool for organizations to manage
                            projects, achieve milestones and keep track of project spendings. PROMIS is developed by <strong>Dakoii Systems</strong>.
                        </p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="h-100 p-3 bg-light rounded">
                                <h5 class="border-bottom pb-2"><i class="fas fa-tasks me-2 text-primary"></i>Comprehensive Management</h5>
                                <p>
                                    PROMIS is a comprehensive web-based system that caters to the project management needs of organizations. It provides a one-stop solution for managing projects and tracking milestones. Project managers can easily store and manage files, track budgets and payments, manage contractors, and generate completion certificates.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="h-100 p-3 bg-light rounded">
                                <h5 class="border-bottom pb-2"><i class="fas fa-map-marked-alt me-2 text-primary"></i>GPS Tracking</h5>
                                <p>
                                    One of the unique features of PROMIS is its capability to store and display project GPS points on a map. This enables project managers to monitor and track progress in real-time, using the integrated GPS tracking functionality. This feature is especially useful for construction and engineering projects where location is a critical factor.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="h-100 p-3 bg-light rounded">
                                <h5 class="border-bottom pb-2"><i class="fas fa-mobile-alt me-2 text-primary"></i>Responsive Design</h5>
                                <p>
                                    PROMIS is compatible with any screen size, including smartphones and laptops. This means that project managers can access the system from any device, allowing them to manage projects on the go. The system is designed to be user-friendly, with an intuitive interface that makes it easy to navigate and perform various tasks.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="h-100 p-3 bg-light rounded">
                                <h5 class="border-bottom pb-2"><i class="fas fa-chart-bar me-2 text-primary"></i>Reporting Capabilities</h5>
                                <p>
                                    PROMIS provides robust reporting capabilities, with the ability to generate various reports based on project data. Project managers can generate reports on project progress, budgets, payments, and milestones. The system also provides a summary dashboard that displays an overview of all ongoing projects.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-primary">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-lightbulb fa-2x"></i>
                            </div>
                            <div>
                                <h5>Contractor Management</h5>
                                <p class="mb-0">
                                    The system is designed to manage contractors efficiently, with the ability to store and manage contractor information, including contact details, qualifications, and experience. PROMIS enables project managers to track the progress of contractors and generate completion certificates based on the completion of project milestones.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 p-4 bg-light rounded">
                        <h5 class="text-center mb-3">In Summary</h5>
                        <p class="mb-0">
                            PROMIS is an all-in-one project management system that provides a comprehensive solution for managing projects, tracking milestones, and managing contractors. With its GPS tracking functionality, compatibility with any screen size, and robust reporting capabilities, PROMIS is an ideal solution for organizations looking to streamline their project management processes.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>