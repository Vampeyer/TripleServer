from http.server import BaseHTTPRequestHandler, HTTPServer

class RequestHandler(BaseHTTPRequestHandler):
    def do_GET(self):
        self.send_response(200)
        self.send_header('Content-type', 'text/html')
        self.end_headers()
        with open('hellyeah.html', 'rb') as f:
            self.wfile.write(f.read())

def run_server():
    server = HTTPServer(('', 8001), RequestHandler)
    print('Server running at http://localhost:8001/')
    server.serve_forever()

if __name__ == "__main__":
    run_server()
