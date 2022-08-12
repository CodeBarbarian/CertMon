===================================================================================
                        CertMon - Certificate Monitoring
===================================================================================

Author: Morten Haugstad
Version: 1.0
Description: Certificate Monitoring tool

==========================
Changelog:
==========================
___________
11.08.2022:
    Added:
        * New directory structure
        * Helper Legend, and initial landing page for ease of use
        * The ability to add Certificates
        * The ability to remove certificates
        * The ability to view certificates
        * All the initial logic.

___________
12.08.2022:
    Added:
        * The logic behind the sorting of the certificate array that is shown in /certificate/list.
            - This is to make sure that certificates that are expiring are shown first.
        * Started working on the Email handler.
    Modified:
        * The CertificateModel after finding a bug which produces array to string conversion errors

    Deleted: