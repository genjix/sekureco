import pycurl

def write(a):
    a = a.strip('\n')
    print 'abra|%s|'%a

c = pycurl.Curl()
#c.setopt(c.POST, 1)
if True:
    # retrieve secret passcode
    c.setopt(c.URL, 'http://localhost/retr.php')
    c.setopt(c.HTTPPOST, [('nickname', 'genjix'),
                          ('password', 'qwerty')])
else:
    # upload file
    c.setopt(c.URL, 'http://localhost/up.php')
    c.setopt(c.HTTPPOST, [('nickname', 'genjix'),
                          ('password', 'z0vehj19x4q8y4r9tglee11tyb56tjclgtfuhx13qrj9pcs23yxqupuhp8oz1jgun99xnbv6vr9quajl'),
                          #('file', (c.FORM_FILE, 'secrets.enc.zip'))])
                          ('file', (c.FORM_FILE, 'buttercup.enc'))])
#c.setopt(c.VERBOSE, 1)
c.setopt(c.WRITEFUNCTION, write)
c.perform()
c.close()

