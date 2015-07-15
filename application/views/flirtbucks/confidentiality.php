<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        $('#date').focus(function() {
            if ($(this).val() == 'mm/dd/yyyy')
            {
                $(this).val('');
                $(this).css('color', '#000');
            }
        });

        $('#date').blur(function() {
            if ($(this).val() == '')
            {
                $(this).val('mm/dd/yyyy');
                $(this).css('color', '#bbb');
            }
        });
    });
</script>

<div style="width: 900px; margin: 0 auto;">
    <h1 style="text-align: center;">Confidentiality Agreement</h1>

    <p>As a Chat Hostess you may become privy to confidential company information, personal and private information exchanged with other users and trade secrets. Because of this we require all approved Chat Hostess applicants to enter into a confidentiality and non-disclosure agreement as a condition of paticipation in the program.</p>

    <div style="height: 200px; border: 2px solid #95999C; padding: 5px; overflow: scroll; background-color: #fff;">
        <h1 style="color: #10476C; text-align: center;">CONFIDENTIALITY AGREEMENT</h1>
        <p style="color: #10476C;">This Agreement is entered into effective as of <?= date('m/d/Y'); ?> between FlirtBucks, a property of Swurve Media Corporation (the “Company”), and the undersigned individual (“Recipient”).</p>
        <p style="color: #10476C;">Recipient is acting as an independent contractor in connection with the FlirtBucks.net Chat Hostess program, and for that purpose the Company may make certain Trade Secrets and Confidential Information (as defined below) available to the Recipient (the "Purpose"). As a condition to, and in consideration of, the Company's furnishing of Confidential Information to the Recipient, the Recipient agrees to the restrictions and undertakings contained in this Agreement.</p>
        <p style="color: #10476C;">Recipient agrees that all information disclosed by the Company to Recipient, including any such information disclosed prior to the date of this Agreement, and including without limitation information acquired by Recipient in writing, orally or by inspection of the Company’s property, relating to (without limitation) the Company’s technical data, trade secrets, know how, products, product plans, services, software, inventions, processes, discoveries, formulas, architectures, concepts, ideas, designs, drawings, personnel, customers, computer programs, confidential information disclosed to the Company by third parties, and other data, whether oral, written, graphic, or electronic form shall be considered "Confidential Information". </p>
        <p style="color: #10476C;">Recipient agrees (i) to use Confidential Information solely for the Purpose; (ii) to use all possible means to maintain the Confidential Information in strict confidence, and at least those measures that it employs for the protection of its own confidential information, but in any event not less than a reasonable degree of care, (iii) to disclose Confidential Information only to Recipient’s employees who are required to have the information for the Purpose and have previously signed an agreement in content similar to the provisions hereof; and (iv) to immediately notify in writing the Company in the event of any unauthorized use or disclosure of the Confidential Information. Recipient shall not reverse engineer, disassemble, decompile or copy any software or other tangible objects which embody the Confidential Information, nor export or re-export or otherwise transmit, directly or indirectly, any Confidential Information, or the direct product of Confidential Information, except with the applicable government export approvals or export permits.</p>
        <p style="color: #10476C;">All Confidential Information and all of the Company’s trademarks remain the property of the Company and no license or other rights in the Confidential Information or such trademarks are granted hereby, except as expressly provided above. This Agreement does not constitute a joint venture or other such business agreement. All information is provided “as is” and without any warranty, express, implied, or otherwise, regarding its accuracy or performance.</p>
        <p style="color: #10476C;">Recipient hereby acknowledges that unauthorized disclosure or use of Confidential Information could cause irreparable harm and significant injury, which may be difficult to ascertain. Accordingly, Recipient agrees that the Company shall have the right to seek and obtain immediate injunctive relief from breaches of this Agreement, in addition to any other rights and remedies it may have. Recipient’s obligations hereunder shall survive termination or expiration of this agreement until such time as all Confidential Information disclosed hereunder becomes publicly known and made generally available through no action or inaction of Recipient.</p>
        <p style="color: #10476C;">This Agreement shall bind and inure to the benefit of the parties hereto and their successors and assigns, except that Confidential Information and the rights and obligations under this Agreement may not be assigned by Recipient without prior written consent of the Company. This document contains the entire agreement between the parties with respect to the subject matter hereof, and may not be amended, nor any obligation waived, except by a writing signed by both parties hereto. Any failure to enforce any provision of this Agreement shall not constitute a waiver thereof or of any other provision. This Agreement shall be governed by and construed and enforced in accordance with the laws of the State of Florida excluding that body of law pertaining to conflict of law, and the parties hereto agree to submit to the exclusive jurisdiction of the courts of Pinellas County any disputes arising out of the subject matter.</p>
        <p style="color: #10476C;"><strong>E-Signature-</strong></p>
        <p style="color: #10476C;">FlirtBucks requires that you certify your understanding and acceptance of this confidentiality agreement by submitting an electronic signature.  To accept this agreement please indicate that you have read and understood the document and type your first and last name and today’s date into the fields below</p>
        <p style="color: #10476C;">I affirm that I have read, understood and fully agree to the terms outlined in the above agreement.</p>
    </div><br />

    <p>FlirtBucks requires that you certify your understanding and acceptance of this confidentiality agreement by submitting an electronic signature.  To accept this agreement please indicate that you have read and understood the document and type your first and last name and today’s date into the fields below..</p>

    <?= Form::open(); ?>
    <div style="width: 100%; border: 2px solid #95999C; background-color: #D4106A; padding: 5px;">
        <h1 style="text-align: center; color: #fff">E- SIGNATURE</h1>

        <div style="width: 90%; background-color: #fff; border: 1px solid #95999C; margin: 0 auto; padding: 5px; text-align: center;">
            <?= Form::checkbox('agree', 'Yes'); ?> I affirm that I have read, understood and fully agree to the terms outlined in the above agreement.<br /><br />
            Name/E-Signature: <?= Form::input('signature', NULL, array('id' => 'signature', 'style' => 'width: 400px;')); ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date: <?= Form::input('date', 'mm/dd/yyyy', array('id' => 'date', 'style' => 'width: 100px; color: #bbb')); ?>
        </div>
    </div><br />

    <center><?= Form::input('submit', 'agree', array('id' => 'register-submit', 'type' => 'image', 'src' => '/assets/img/flirtbucks/button-submit.png')); ?></center>
    <?= Form::close(); ?>
</div>