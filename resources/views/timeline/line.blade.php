<!-- filepath: resources/views/home.blade.php -->
@extends('layouts.app')
@section('css')
    <style>
        .workflow-section {
            background: #f7f7fd;
            padding: 80px 0;
        }

        .workflow-title {
            font-weight: 700;
            color: #1E90FF;
            margin-bottom: 2rem;
            text-align: center;
            font-size: 2.2rem;
        }

        .workflow-steps {
            max-width: 900px;
            margin: auto;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .workflow-step {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 2px 8px #e7e5f9;
            padding: 2rem 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
        }

        .workflow-step-number {
            background: #4361EE;
            color: #fff;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            font-weight: bold;
            flex-shrink: 0;
        }

        .workflow-step-content {
            flex: 1;
        }

        .workflow-step-title {
            font-weight: 700;
            color: #1E90FF;
            margin-bottom: 0.3rem;
            font-size: 1.15rem;
        }

        .workflow-step-desc {
            color: #333;
            font-size: 1rem;
        }

        @media (max-width: 600px) {
            .workflow-step {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .workflow-step-number {
                margin-bottom: 1rem;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section ... (keep your existing hero/steps/about/testimonials sections above or below as you wish) -->

    <!-- Workflow Section -->
    <section class="workflow-section">
        <div class="container">
            <div class="workflow-title">How the Platform Works</div>
            <div class="workflow-steps">
                <div class="workflow-step">
                    <div class="workflow-step-number">1</div>
                    <div class="workflow-step-content">
                        <div class="workflow-step-title">Submit Your Requirements</div>
                        <div class="workflow-step-desc">
                            Enter your project requirements and location on the platform.
                        </div>
                    </div>
                </div>
                <div class="workflow-step">
                    <div class="workflow-step-number">2</div>
                    <div class="workflow-step-content">
                        <div class="workflow-step-title">Consultant Proposals</div>
                        <div class="workflow-step-desc">
                            Registered consultants in your area send you designs, material lists, and price offers.
                        </div>
                    </div>
                </div>
                <div class="workflow-step">
                    <div class="workflow-step-number">3</div>
                    <div class="workflow-step-content">
                        <div class="workflow-step-title">Choose a Consultant</div>
                        <div class="workflow-step-desc">
                            Review the offers and select the consultant that fits your needs. Approve their proposal.
                        </div>
                    </div>
                </div>
                <div class="workflow-step">
                    <div class="workflow-step-number">4</div>
                    <div class="workflow-step-content">
                        <div class="workflow-step-title">Contractor Offers</div>
                        <div class="workflow-step-desc">
                            The approved design and material list are sent to contractors. They submit their bids to you.
                        </div>
                    </div>
                </div>
                <div class="workflow-step">
                    <div class="workflow-step-number">5</div>
                    <div class="workflow-step-content">
                        <div class="workflow-step-title">Choose a Contractor</div>
                        <div class="workflow-step-desc">
                            Review contractor offers and select the best one for your project.
                        </div>
                    </div>
                </div>
                <div class="workflow-step">
                    <div class="workflow-step-number">6</div>
                    <div class="workflow-step-content">
                        <div class="workflow-step-title">E-Signature & Project Start</div>
                        <div class="workflow-step-desc">
                            Both you and the contractor sign electronically on the platform. The project begins.
                        </div>
                    </div>
                </div>
                <div class="workflow-step">
                    <div class="workflow-step-number">7</div>
                    <div class="workflow-step-content">
                        <div class="workflow-step-title">Project Updates & Supervision</div>
                        <div class="workflow-step-desc">
                            Track project updates on the platform. The consultant supervises each stage, and you approve
                            every phase.
                        </div>
                    </div>
                </div>
                <div class="workflow-step">
                    <div class="workflow-step-number">8</div>
                    <div class="workflow-step-content">
                        <div class="workflow-step-title">Project Delivery</div>
                        <div class="workflow-step-desc">
                            The project continues with regular updates until final delivery and your full satisfaction.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
